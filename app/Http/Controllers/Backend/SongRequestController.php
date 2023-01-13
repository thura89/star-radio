<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSongRequest;
use App\Http\Requests\UpdateSongRequest;
use App\Models\SongRequest;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Carbon\Carbon;


class SongRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SongRequest::query()->latest();
            return Datatables::of($data)
                        ->addIndexColumn()
                        ->editColumn('title',function($each){
                            return Str::limit($each->title,45,'...');
                        })
                        ->editColumn('message',function($each){
                            return Str::limit($each->message,100,'...');
                        })
                        ->editColumn('updated_at',function($each){
                            return Carbon::parse($each->created_at)->format('d-m-y H:i:s');
                        })
                        ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$id}}" />')
                        ->addColumn('action', function($each){

                            $info = '<a href="'. route('admin.song_requests.show',$each->id) .'" type="button" class="btn btn-info btn-rounded">
                                            <i class="material-icons">fullscreen</i>
                                    </a>';
                            $edit = '<a href="'. route('admin.song_requests.edit',$each->id) .'" type="button" class="btn btn-light btn-rounded">
                                            <i class="material-icons">edit</i>
                                    </a>';
                            $delete = '<a href="#" type="button" class="btn btn-danger btn-rounded delete" data-id="' . $each->id . '">
                                            <i class="material-icons">close</i>
                                        </a>';
                            $collect = $info.$edit.$delete;
                            $action = '<div class="button-list">'.$collect.'</div>';
                            return $action ;
                        })
                        ->rawColumns(['action','checkbox'])
                        ->make(true);
        }
        return view('backend.song_requests.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.song_requests.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSongRequest $request)
    {
        $data = new SongRequest();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->songname = $request->songname;
        $data->artist = $request->artist;
        $data->message = $request->message;
        $data->save();
        return redirect()->route('admin.song_requests.index')->with('create', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SongRequest  $songRequest
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = SongRequest::findOrFail($id);
        $data->read_at = Carbon::now();
        $data->update();
        return view('backend.song_requests.edit',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SongRequest  $songRequest
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = SongRequest::findOrFail($id);
        $data->read_at = Carbon::now();
        $data->update();
        return view('backend.song_requests.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SongRequest  $songRequest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSongRequest $request,$id)
    {
        $data = SongRequest::findOrFail($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->songname = $request->songname;
        $data->artist = $request->artist;
        $data->message = $request->message;
        $data->update();
        return redirect()->route('admin.song_requests.index')->with('update', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SongRequest  $songRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = SongRequest::findOrFail($request->input('rid'));
        if($data->delete())
        {
            return response()->json(array('success' => true, 'data' => $data));
        }
    }

    function removeall(Request $request)
    {
        $id_array = $request->input('id');
        $datas = SongRequest::whereIn('id', $id_array);
        if($datas->delete())
        {
            return response()->json(array('success' => true, 'data' => $id_array));
        }
    }
}
