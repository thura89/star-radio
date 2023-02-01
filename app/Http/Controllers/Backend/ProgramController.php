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
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;

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
                ->editColumn('image', function ($each) {
                    return '<div class="avatar avatar-lg avatar-4by3">
                                        <img src="' . $each->program_img_path() . '" alt="" class="avatar-img rounded">    
                                    </div>';
                })
                ->editColumn('title', function ($each) {
                    return Str::limit($each->title, 45, '...');
                })

                ->editColumn('category_id', function ($each) {
                    return $each->category->title ?? '-';
                })
                ->editColumn('body', function ($each) {
                    return Str::limit($each->body, 45, '...');
                })
                ->editColumn('files', function ($each) {
                    // return Str::limit($each->files,45,'...');
                    return '<audio controls onplay="pauseOthers(this)">
                            <source src="' . $each->program_audio_path() . '" type="audio/mpeg">
                          Your browser does not support the audio element.
                          </audio>';
                })
                ->editColumn('updated_at', function ($each) {
                    return Carbon::parse($each->created_at)->format('d-m-y H:i:s');
                })
                ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$id}}" />')
                ->addColumn('action', function ($each) {

                    $info = '<a href="' . route('admin.programs.show', $each->id) . '" type="button" class="btn btn-info btn-rounded">
                                            <i class="material-icons">fullscreen</i>
                                    </a>';
                    $edit = '<a href="' . route('admin.programs.edit', $each->id) . '" type="button" class="btn btn-light btn-rounded">
                                            <i class="material-icons">edit</i>
                                    </a>';
                    $delete = '<a href="#" type="button" class="btn btn-danger btn-rounded delete" data-id="' . $each->id . '">
                                            <i class="material-icons">close</i>
                                        </a>';
                    $collect = $info . $edit . $delete;
                    $action = '<div class="button-list">' . $collect . '</div>';
                    return $action;
                })
                ->rawColumns(['action', 'image', 'files','checkbox'])
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
        $categories = Category::select('id', 'title')->get();
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
            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $image = Str::random(5) . "-" . date('his') . "-" . Str::random(3) . "." . $extension;
                Storage::disk('public')->put('programs/image/' . $image, file_get_contents($file));
            }
        }
        // return $request->all();
        $audio = $request->audio_file;
        // foreach ($request->files as $file) {
        //     $audio = $file;
        // }
        $data = new Program();
        $data->title = $request->title;
        $data->category_id = $request->category_id;
        $data->body = $request->body;
        $data->image = $image;
        $data->files = $audio ?? null;
        $data->trending = $request->trending ?? '0';
        $data->save();

        return redirect()->route('admin.programs.index')->with('create', 'Created Successfully');
    }

    public function uploadAudioFiles(Request $request)
    {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            // file not uploaded
        }

        $fileReceived = $receiver->receive(); // receive file
        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $file = $fileReceived->getFile(); // get file
            $extension = $file->getClientOriginalExtension();
            $fileName = str_replace('.' . $extension, '', $file->getClientOriginalName()); //file name without extenstion
            $fileName .= '_' .time(). '.' . $extension; // a unique file name

            Storage::disk('public')->put('programs/audio_file/' . $fileName, file_get_contents($file));
            // delete chunked file
            unlink($file->getPathname());
            return [
                'path' => asset('storage/programs/audio_file/' . $fileName),
                'filename' => $fileName
            ];
        }

        // otherwise return percentage information
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true
        ];
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
        $categories = Category::select('id', 'title')->get();
        return view('backend.programs.edit', compact('categories', 'data'));
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
        $categories = Category::select('id', 'title')->get();
        return view('backend.programs.edit', compact('categories', 'data'));
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
            Storage::disk('public')->delete('/programs/image/' . $image);
            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $image = Str::random(5) . "-" . date('his') . "-" . Str::random(3) . "." . $extension;
                Storage::disk('public')->put('programs/image/' . $image, file_get_contents($file));
            }
        }
        $audio_file = $data->files;
        if ($request->audio_file) {
            Storage::disk('public')->delete('/programs/audio_file/' . $audio_file);
            $audio_file = $request->audio_file;
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

    function removeall(Request $request)
    {
        $id_array = $request->input('id');
        $datas = Program::whereIn('id', $id_array);
        foreach ($id_array as $key => $data) {
            $data = Program::findOrFail($data);
            Storage::disk('public')->delete('programs/image/' . $data->image);
            Storage::disk('public')->delete('programs/audio_file/' . $data->files);
        }
        if($datas->delete())
        {
            return response()->json(array('success' => true, 'data' => $id_array));
        }
    }
}
