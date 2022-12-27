<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Program;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProgram;
use App\Http\Requests\UpdateProgram;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Program::query()->with('category')->latest();
            return Datatables::of($data)
                        ->addIndexColumn()
                        ->editColumn('image',function($each){
                            return '<div class="avatar avatar-lg avatar-4by3">
                                        <img src="'.$each->program_img_path().'" alt="" class="avatar-img rounded">    
                                    </div>';
                        })
                        ->editColumn('title',function($each){
                            return Str::limit($each->title,45,'...');
                        })
                        
                        ->editColumn('category_id',function($each){
                            return $each->category_id ? $each->category->title  : '-';
                        })
                        ->editColumn('body',function($each){
                            return Str::limit($each->body,45,'...');
                        })
                        ->editColumn('files',function($each){
                            // return Str::limit($each->files,45,'...');
                            return '<audio controls onplay="pauseOthers(this)">
                            <source src="'.$each->program_audio_path().'" type="audio/mpeg">
                          Your browser does not support the audio element.
                          </audio>';
                        })
                        ->editColumn('updated_at',function($each){
                            return Carbon::parse($each->created_at)->format('d-m-y H:i:s');
                        })
                        ->addColumn('action', function($each){

                            $info = '<a href="'. route('admin.programs.show',$each->id) .'" type="button" class="btn btn-info btn-rounded">
                                            <i class="material-icons">fullscreen</i>
                                    </a>';
                            $edit = '<a href="'. route('admin.programs.edit',$each->id) .'" type="button" class="btn btn-light btn-rounded">
                                            <i class="material-icons">edit</i>
                                    </a>';
                            $delete = '<a href="#" type="button" class="btn btn-danger btn-rounded delete" data-id="' . $each->id . '">
                                            <i class="material-icons">close</i>
                                        </a>';
                            $collect = $info.$edit.$delete;
                            $action = '<div class="button-list">'.$collect.'</div>';
                            return $action ;
                        })
                        ->rawColumns(['action','image','files'])
                        ->make(true);
        }
        return view('backend.programs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id','title')->get();
        return view('backend.programs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProgram $request)
    {
        $image = null;
        if ($request->hasFile('image')) {
            $files = $request->file('image');
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $image = Str::random(5)."-".date('his')."-". Str::random(3).".".$extension;
                Storage::disk('public')->put('programs/image/'.$image, file_get_contents($file));
            }
        }
        $audio_file = null;
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $audio_file = Str::random(5)."-".date('his')."-". Str::random(3).".".$extension;
                Storage::disk('public')->put('programs/audio_file/'.$audio_file, file_get_contents($file));
            }
        }
        $data = new Program();
        $data->title = $request->title;
        $data->category_id = $request->category_id;
        $data->body = $request->body;
        $data->image = $image;
        $data->files = $audio_file;
        $data->trending = $request->trending ?? '0';
        $data->save();

        return redirect()->route('admin.programs.index')->with('create', 'Created Successfully');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Program::findOrFail($id);
        $categories = Category::select('id','title')->get();
        return view('backend.programs.edit', compact('categories','data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Program::findOrFail($id);
        $categories = Category::select('id','title')->get();
        return view('backend.programs.edit', compact('categories','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProgram $request, $id)
    {
        $data = Program::findOrFail($id);

        $image = $data->image;
        if ($request->hasFile('image')) {
            $files = $request->file('image');
            Storage::disk('public')->delete('/programs/image/'.$image);
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $image = Str::random(5)."-".date('his')."-". Str::random(3).".".$extension;
                Storage::disk('public')->put('programs/image/'.$image, file_get_contents($file));
            }
        }
        $audio_file = $data->files;
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            Storage::disk('public')->delete('/programs/audio_file/'.$audio_file);
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $audio_file = Str::random(5)."-".date('his')."-". Str::random(3).".".$extension;
                Storage::disk('public')->put('programs/audio_file/'.$audio_file, file_get_contents($file));
            }
        }
        
        $data->title = $request->title;
        $data->category_id = $request->category_id;
        $data->body = $request->body;
        $data->image = $image;
        $data->files = $audio_file;
        $data->trending = $request->trending ?? '0';
        $data->save();

        return redirect()->route('admin.programs.index')->with('update', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Program::findOrFail($id);
        Storage::disk('public')->delete('programs/image/' . $data->image);
        Storage::disk('public')->delete('programs/audio_file/' . $data->files);
        $data->delete();
    }
}
