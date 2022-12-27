<?php

namespace App\Http\Controllers\Backend;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSlider;
use App\Http\Requests\UpdateSlider;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Slider::query()->latest();
            return Datatables::of($data)
                        ->addIndexColumn()
                        ->editColumn('title',function($each){
                            return Str::limit($each->title,45,'...');
                        })
                        ->editColumn('description',function($each){
                            return Str::limit($each->description,145,'...');
                        })
                        ->editColumn('front_image',function($each){
                            return '<div class="avatar avatar-lg avatar-4by3">
                                        <img src="'.$each->slider_front_img_path().'" alt="" class="avatar-img rounded">    
                                    </div>';
                        })
                        ->editColumn('updated_at',function($each){
                            return Carbon::parse($each->created_at)->format('d-m-y H:i:s');
                        })
                        ->editColumn('status',function($each){
                            // Publish status = 1
                            if ($each->status == 1) {
                                return '<span class="btn btn-outline-success btn-rounded">'.config('const.slider_status.1').'</span>';
                            }else{
                                return '<span class="btn btn-outline-secondary btn-rounded">'.config('const.slider_status.0').'</span>';
                            }
                        }) 
                        ->addColumn('action', function($each){

                            $info = '<a href="'. route('admin.sliders.show',$each->id) .'" type="button" class="btn btn-info btn-rounded">
                                            <i class="material-icons">fullscreen</i>
                                    </a>';
                            $edit = '<a href="'. route('admin.sliders.edit',$each->id) .'" type="button" class="btn btn-light btn-rounded">
                                            <i class="material-icons">edit</i>
                                    </a>';
                            $delete = '<a href="#" type="button" class="btn btn-danger btn-rounded delete" data-id="' . $each->id . '">
                                            <i class="material-icons">close</i>
                                        </a>';
                            $collect = $info.$edit.$delete;
                            $action = '<div class="button-list">'.$collect.'</div>';
                            return $action ;
                        })
                        ->rawColumns(['action','front_image','status'])
                        ->make(true);
        }
        return view('backend.sliders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSlider $request)
    {
        $front_image = null;
        if ($request->hasFile('front_image')) {
            $files = $request->file('front_image');
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $front_image = 'slider_front_'.Str::random(5)."-".date('his')."-". Str::random(3).".".$extension;
                Storage::disk('public')->put('sliders/front_image/'.$front_image, file_get_contents($file));
            }
        }
        $background_image = null;
        if ($request->hasFile('background_image')) {
            $files = $request->file('background_image');
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $background_image = 'slider_background'.Str::random(5)."-".date('his')."-". Str::random(3).".".$extension;
                Storage::disk('public')->put('sliders/background_image/'.$background_image, file_get_contents($file));
            }
        }
        $data = new Slider();
        $data->title = $request->title;
        $data->description = $request->description;
        $data->status = $request->status ?? '0';
        $data->front_image = $front_image;
        $data->background_image = $background_image;
        $data->save();

        return redirect()->route('admin.sliders.index')->with('create', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        return view('backend.sliders.edit', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('backend.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */

    public function update(UpdateSlider $request, $id)
    {
        $data = Slider::findOrFail($id);
        $front_image = $data->front_image;
        if ($request->hasFile('front_image')) {
            Storage::disk('public')->delete('/sliders/front_image/'.$front_image);
            $files = $request->file('front_image');
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $front_image = 'slider_front_'.Str::random(5)."-".date('his')."-". Str::random(3).".".$extension;
                Storage::disk('public')->put('/sliders/front_image/'.$front_image, file_get_contents($file));
                
            }
        }
        $background_image = $data->background_image;
        if ($request->hasFile('background_image')) {
            Storage::disk('public')->delete('/sliders/background_image/'.$background_image);
            $files = $request->file('background_image');
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $background_image = 'slider_background'.Str::random(5)."-".date('his')."-". Str::random(3).".".$extension;
                Storage::disk('public')->put('/sliders/background_image/'.$background_image, file_get_contents($file));
                
            }
        }
        $data->title = $request->title;
        $data->description = $request->description;
        $data->status = $request->status ?? '0';
        $data->front_image = $front_image;
        $data->background_image = $background_image;
        $data->update();

        return redirect()->route('admin.sliders.index')->with('update', 'Successfully Updated');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Slider::findOrFail($id);
        Storage::disk('public')->delete('sliders/front_image/' . $data->front_image);
        Storage::disk('public')->delete('sliders/background_image/' . $data->background_image);
        $data->delete();
    }
}
