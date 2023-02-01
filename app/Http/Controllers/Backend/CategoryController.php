<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Program;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategory;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::query();
            return Datatables::of($data)
                        ->addIndexColumn()
                        ->editColumn('image',function($each){
                            return '<div class="avatar avatar-lg avatar-4by3">
                                        <img src="'.$each->category_img_path().'" alt="" class="avatar-img rounded">    
                                    </div>';
                        })
                        ->editColumn('title',function($each){
                            return Str::limit($each->title,45,'...');
                        })
                        ->editColumn('descriptions',function($each){
                            return Str::limit($each->descriptions,145,'...');
                        })
                        ->editColumn('updated_at',function($each){
                            return Carbon::parse($each->created_at)->format('d-m-y H:i:s');
                        })
                        ->addColumn('action', function($each){

                            $info = '<a href="'. route('admin.categories.show',$each->id) .'" type="button" class="btn btn-info btn-rounded">
                                            <i class="material-icons">fullscreen</i>
                                    </a>';
                            $edit = '<a href="'. route('admin.categories.edit',$each->id) .'" type="button" class="btn btn-light btn-rounded">
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
        return view('backend.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategory $request)
    {
        $image = null;
        if ($request->hasFile('image')) {
            $files = $request->file('image');
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $image = Str::random(5)."-".date('his')."-". Str::random(3).".".$extension;
                Storage::disk('public')->put('categories/'.$image, file_get_contents($file));
            }
        }
        $data = new Category();
        $data->title = $request->title;
        $data->descriptions = $request->descriptions;
        $data->image = $image;
        $data->save();

        return redirect()->route('admin.categories.index')->with('create', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Category::findOrFail($id);
        return view('backend.categories.edit',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Category::findOrFail($id);
        return view('backend.categories.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Category::findOrFail($id);
        $image = $data->image;
        if ($request->hasFile('image')) {
            $files = $request->file('image');
            Storage::disk('public')->delete('categories/'.$image);
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $image = Str::random(5)."-".date('his')."-". Str::random(3).".".$extension;
                Storage::disk('public')->put('categories/'.$image, file_get_contents($file));
            }
        }
        $data->title = $request->title;
        $data->descriptions = $request->descriptions;
        $data->image = $image;
        $data->update();

        return redirect()->route('admin.categories.index')->with('update', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Category::findOrFail($id);
        Storage::disk('public')->delete('categories/' . $data->image);
        $data->delete();

        foreach ($data->programs as $key => $data) {
            $data = Program::findOrFail($data->id);
            Storage::disk('public')->delete('programs/image/' . $data->image);
            Storage::disk('public')->delete('programs/audio_file/' . $data->files);
            $data->delete();
        }
        
        // Storage::disk('public')->delete('categories/' . $data->image);
        // $data->delete();
    }
}
