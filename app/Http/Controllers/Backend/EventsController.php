<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\News;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEvent;
use App\Http\Requests\UpdateEvent;
use Illuminate\Support\Facades\Storage;

class EventsController extends Controller
{
    public function index(Request $request)
    {
        // return 'here';
        if ($request->ajax()) {
            // News Category Local/International
            $data = Event::query();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('event_photo', function ($each) {
                    return '<div class="avatar avatar-lg avatar-4by3">
                                        <img src="' . $each->event_photo_path() . '" alt="" class="avatar-img rounded">    
                                    </div>';
                })
                ->editColumn('title', function ($each) {
                    return Str::limit($each->title, 45, '...');
                })
                ->editColumn('location', function ($each) {
                    return $each->location;
                })
                ->editColumn('event_date', function ($each) {
                    return Carbon::parse($each->event_date)->format('d-m-y');
                })
                ->addColumn('action', function ($each) {

                    $info = '<a href="' . route('admin.events.show', $each->id) . '" type="button" class="btn btn-info btn-rounded">
                                            <i class="material-icons">fullscreen</i>
                                    </a>';
                    $edit = '<a href="' . route('admin.events.edit', $each->id) . '" type="button" class="btn btn-light btn-rounded">
                                            <i class="material-icons">edit</i>
                                    </a>';
                    $delete = '<a href="#" type="button" class="btn btn-danger btn-rounded delete" data-id="' . $each->id . '">
                                            <i class="material-icons">close</i>
                                        </a>';
                    $collect = $info . $edit . $delete;
                    $action = '<div class="button-list">' . $collect . '</div>';
                    return $action;
                })
                ->rawColumns(['action', 'event_photo'])
                ->make(true);
        }
        return view('backend.events.index');
    }

    public function create()
    {
        return view('backend.events.create');
    }

    public function store(StoreEvent $request)
    {

        $event_photo_name = null;
        if ($request->hasFile('event_photo')) {
            $files = $request->file('event_photo');
            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $event_photo_name = uniqid() . '_' . time() . "." . $extension;
                Storage::disk('public')->put('events/photo/' . $event_photo_name, file_get_contents($file));
            }
        }

        $event_image_data = [];
        /* Event Image */
        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $image) {
                $event_image_name = uniqid() . '_' . time() . '.' . $image->extension();
                Storage::disk('public')->put('events/image/' . $event_image_name, file_get_contents($image));
                $event_image_data[] = $event_image_name;
            }
        }

        $data = new Event();
        $data->title = $request->title;
        $data->location = $request->location;
        $data->event_date = $request->event_date;
        $data->event_photo = $event_photo_name;
        $data->body = $request->body;
        $data->image = json_encode($event_image_data);
        $data->save();

        return redirect()->route('admin.events.index')->with('create', 'Created Successfully');
    }

    public function edit($id)
    {
        $data = Event::findOrFail($id);
        $decode_images = json_decode($data['image']);
        $images = [];
        foreach ($decode_images as $key => $image) {
            $images[] = [
                'id' => $image,
                'src' => asset(config('const.event_image_path')).'/' . $image
            ];
        }
        $images = json_encode($images);
        return view('backend.events.edit', compact('data','images'));
    }

    public function show($id)
    {
        $data = Event::findOrFail($id);
        $decode_images = json_decode($data['image']);
        $images = [];
        foreach ($decode_images as $key => $image) {
            $images[] = [
                'id' => $image,
                'src' => asset(config('const.event_image_path')).'/' . $image
            ];
        }
        $images = json_encode($images);
        return view('backend.events.edit', compact('data','images'));
    }

    public function update($id, UpdateEvent $request)
    {
        $data_result = Event::findOrFail($id);
        $event_photo_name = $data_result->event_photo;
        if ($request->hasFile('event_photo')) {
            Storage::disk('public')->delete('/events/photo/' . $event_photo_name);
            $files = $request->file('event_photo');
            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $event_photo_name = uniqid() . '_' . time() . "." . $extension;
                Storage::disk('public')->put('/events/photo/' . $event_photo_name, file_get_contents($file));
            }
        }
        
        /* Splice if not image  */
        if ($request->old || $request->photos) {
            $old_data = $request->old ?? [];
            $count = count($request->file('photos') ?? []);
            $data = array_reverse($old_data);
            $splice_data = array_splice($data, $count);

            /* Fetch Old Image */
            $store_data = json_decode($data_result->image);

            /* Diff image */
            $collection = collect($store_data);
            $diff_image = $collection->diff($splice_data);

            /* Delete image */
            if (!$diff_image->all() == []) {
                foreach ($diff_image as $key => $diff) {
                    Storage::disk('public')->delete('/events/image/' . $diff);
                }
            }

            /* Get Remain Data from coming form */
            foreach ($splice_data as $image) {
                $data[] = $image;
            }

            /* Upload New image */
            if ($request->hasfile('photos')) {
                foreach ($request->file('photos') as $image) {
                    $file_name = uniqid() . '_' . time() . '.' . $image->extension();
                    Storage::disk('public')->put('events/image/' . $file_name, file_get_contents($image));
                    $data[] = $file_name;
                }
            }
            /* Splice No Need Data */
            $filtered = array_splice($data, $count);
            $data_result->image = json_encode($filtered);
        }

        $data_result->title = $request->title;
        $data_result->location = $request->location;
        $data_result->event_date = $request->event_date;
        $data_result->event_photo = $event_photo_name;
        $data_result->body = $request->body;
        $data_result->update();
        return redirect()->route('admin.events.index')->with('update', 'Successfully Updated');
    }

    public function destroy($id)
    {
        $data = Event::findOrFail($id);
        Storage::disk('public')->delete('/events/photo/' . $data->event_photo);

        $decode_images = json_decode($data['image']);
        foreach ($decode_images as $key => $image) {
            Storage::disk('public')->delete('/events/image/' . $image);
        }
        $data->delete();
    }
}
