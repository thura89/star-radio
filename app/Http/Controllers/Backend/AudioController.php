<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Audio;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\CreateAudio;
use App\Http\Requests\UpdateAudio;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Audio::query()->latest();
            return Datatables::of($data)
                        ->addIndexColumn()
                        ->editColumn('image',function($each){
                            return '<div class="avatar avatar-lg avatar-4by3">
                                        <img src="'.$each->audio_playlist_img_path().'" alt="" class="avatar-img rounded">    
                                    </div>';
                        })
                        ->editColumn('title',function($each){
                            return Str::limit($each->title,45,'...');
                        })
                        ->editColumn('files',function($each){
                            return '<audio controls onplay="pauseOthers(this)">
                                        <source src="'.$each->audio_playlist_file_path().'" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                    </audio>';
                        })
                        ->editColumn('updated_at',function($each){
                            return Carbon::parse($each->created_at)->format('d-m-y H:i:s');
                        })
                        ->addColumn('live-active', function($each){
                            if ($each->series_id == 1 ) {
                                return '<a href="#" type="button" class="btn btn-danger btn-rounded" data-id="' . $each->id . '">
                                            <span class="material-icons">play_circle_filled</span>
                                    </a>';
                            }else{
                                return '<a href="#" type="button" class="btn btn-info btn-rounded liveradio" data-id="' . $each->id . '">
                                            <span class="material-icons">play_circle_filled</span>
                                    </a>';
                            }
                        })
                        ->addColumn('action', function($each){

                            $info = '<a href="'. route('admin.audios.show',$each->id) .'" type="button" class="btn btn-info btn-rounded">
                                            <i class="material-icons">fullscreen</i>
                                    </a>';
                            $edit = '<a href="'. route('admin.audios.edit',$each->id) .'" type="button" class="btn btn-light btn-rounded">
                                            <i class="material-icons">edit</i>
                                    </a>';
                            $delete = '<a href="#" type="button" class="btn btn-danger btn-rounded delete" data-id="' . $each->id . '">
                                            <i class="material-icons">close</i>
                                        </a>';
                            $collect = $info.$edit.$delete;
                            $action = '<div class="button-list">'.$collect.'</div>';
                            return $action ;
                        })
                        ->rawColumns(['action','image','files','live-active'])
                        ->make(true);
        }
        return view('backend.audio_playlists.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.audio_playlists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = null;
        if ($request->hasFile('image')) {
            $files = $request->file('image');
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $image = Str::random(5)."-".date('his')."-". Str::random(3).".".$extension;
                Storage::disk('public')->put('audios/image/'.$image, file_get_contents($file));
            }
        }
        $audio_file = null;
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $audio_file = Str::random(5)."-".date('his')."-". Str::random(3).".".$extension;
                Storage::disk('public')->put('audios/audio_file/'.$audio_file, file_get_contents($file));
            }
        }
        $data = new Audio();
        $data->title = $request->title;
        $data->descriptions = $request->descriptions;
        $data->image = $image;
        $data->files = $audio_file;
        $data->save();

        return redirect()->route('admin.audios.index')->with('create', 'Created Successfully');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Audio  $audio
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Audio::findOrFail($id);
        return view('backend.audio_playlists.edit',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Audio  $audio
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Audio::findOrFail($id);
        return view('backend.audio_playlists.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Audio  $audio
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAudio $request, $id)
    {
        $data = Audio::findOrFail($id);

        $image = $data->image;
        if ($request->hasFile('image')) {
            $files = $request->file('image');
            Storage::disk('public')->delete('/audios/image/'.$image);
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $image = Str::random(5)."-".date('his')."-". Str::random(3).".".$extension;
                Storage::disk('public')->put('audios/image/'.$image, file_get_contents($file));
            }
        }
        $audio_file = $data->files;
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            Storage::disk('public')->delete('/audios/audio_file/'.$audio_file);
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $audio_file = Str::random(5)."-".date('his')."-". Str::random(3).".".$extension;
                Storage::disk('public')->put('audios/audio_file/'.$audio_file, file_get_contents($file));
            }
        }
        
        $data->title = $request->title;
        $data->descriptions = $request->descriptions;
        $data->image = $image;
        $data->files = $audio_file;
        $data->save();

        return redirect()->route('admin.audios.index')->with('update', 'Updated Successfully');
    }

    
    public function liveRadio($id)
    {
        $data = Audio::findOrFail($id);
        $data->series_id = 1; //1 is make live temp 
        $data->update();

        Audio::where('id', '!=', $id)->update([
            'series_id' => 0,
        ]);
        return $data;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Audio  $audio
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Audio::findOrFail($id);
        Storage::disk('public')->delete('audios/image/' . $data->image);
        Storage::disk('public')->delete('audios/audio_file/' . $data->files);
        $data->delete();
    }
}
