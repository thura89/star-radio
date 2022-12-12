<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateNoble;
use App\Http\Requests\UpdateNoble;
use App\Models\Noble;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class NobleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Noble::query();
            return Datatables::of($data)
                        ->addIndexColumn()
                        ->editColumn('title',function($each){
                            return Str::limit($each->title,45,'...');
                        })
                        ->editColumn('body',function($each){
                            return Str::limit($each->body,45,'...');
                        })
                        ->editColumn('image',function($each){
                            return '<div class="avatar avatar-lg avatar-4by3">
                                        <img src="'.$each->nobles_img_path().'" alt="" class="avatar-img rounded">    
                                    </div>';
                        })
                        ->editColumn('noble_category',function($each){
                            return $each->noble_category ? config('const.noble_category')[$each->noble_category] : '-';
                        })
                        ->editColumn('updated_at',function($each){
                            return Carbon::parse($each->created_at)->format('d-m-y H:i:s');
                        })
                        ->addColumn('action', function($each){

                            $info = '<a href="'. route('admin.nobles.show',$each->id) .'" type="button" class="btn btn-info btn-rounded">
                                            <i class="material-icons">fullscreen</i>
                                    </a>';
                            $edit = '<a href="'. route('admin.nobles.edit',$each->id) .'" type="button" class="btn btn-light btn-rounded">
                                            <i class="material-icons">edit</i>
                                    </a>';
                            $delete = '<a href="#" type="button" class="btn btn-danger btn-rounded delete" data-id="' . $each->id . '">
                                            <i class="material-icons">close</i>
                                        </a>';
                            $collect = $info.$edit.$delete;
                            $action = '<div class="button-list">'.$collect.'</div>';
                            return $action ;
                        })
                        ->rawColumns(['action','image'])
                        ->make(true);
        }
        return view('backend.nobles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.nobles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateNoble $request)
    {
        $fileName = null;
        if ($request->hasFile('download_file')) {
            $files = $request->file('download_file');
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $fileName = Str::random(5)."-".date('his')."-". Str::random(3).".".$extension;
                Storage::disk('public')->put('nobles/file/'.$fileName, file_get_contents($file));
            }
        }
        $image = null;
        if ($request->hasFile('image')) {
            $files = $request->file('image');
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $image = Str::random(5)."-".date('his')."-". Str::random(3).".".$extension;
                Storage::disk('public')->put('nobles/image/'.$image, file_get_contents($file));
            }
        }
        $data = new Noble();
        $data->title = $request->title;
        $data->noble_category = $request->noble_category;
        $data->body = $request->body;
        $data->image = $image;
        $data->download_file = $fileName;
        $data->save();

        return redirect()->route('admin.nobles.index')->with('create', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Noble  $noble
     * @return \Illuminate\Http\Response
     */
    public function show(Noble $noble)
    {
        return view('backend.nobles.edit', compact('noble'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Noble  $noble
     * @return \Illuminate\Http\Response
     */
    public function edit(Noble $noble)
    {
        return view('backend.nobles.edit', compact('noble'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Noble  $noble
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNoble $request, $id)
    {
        $data = Noble::findOrFail($id);
        $image = $data->image;
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete('/nobles/image/'.$image);
            $files = $request->file('image');
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $image = Str::random(5)."-".date('his')."-". Str::random(3).".".$extension;
                Storage::disk('public')->put('/nobles/image/'.$image, file_get_contents($file));
                
            }
        }
        $file_name = $data->download_file;
        if ($request->hasFile('download_file')) {
            Storage::disk('public')->delete('/nobles/file/'.$file_name);
            $files = $request->file('download_file');
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $file_name = Str::random(5)."-".date('his')."-". Str::random(3).".".$extension;
                Storage::disk('public')->put('/nobles/file/'.$file_name, file_get_contents($file));
            }
        }
        $data->title = $request->title;
        $data->noble_category = $request->noble_category;
        $data->body = $request->body;
        $data->image = $image;
        $data->download_file = $file_name;
        $data->update();
        return redirect()->route('admin.nobles.index')->with('update', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Noble  $noble
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Noble::findOrFail($id);
        Storage::disk('public')->delete('nobles/image/' . $data->image);
        Storage::disk('public')->delete('nobles/file/' . $data->download_file);
        $data->delete();
    }
}
