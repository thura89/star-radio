<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNews;
use Yajra\Datatables\Datatables;
use App\Http\Requests\UpdateNews;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // News Category Local/International
            $data = News::query()->whereIn('news_category',[1,2])->latest();
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
                                        <img src="'.$each->news_img_path().'" alt="" class="avatar-img rounded">    
                                    </div>';
                        })
                        ->editColumn('news_category',function($each){
                            return $each->news_category ? config('const.news')[$each->news_category] : '-';
                        })
                        ->editColumn('updated_at',function($each){
                            return Carbon::parse($each->created_at)->format('d-m-y H:i:s');
                        })
                        ->addColumn('action', function($each){

                            $info = '<a href="'. route('admin.news.show',$each->id) .'" type="button" class="btn btn-info btn-rounded">
                                            <i class="material-icons">fullscreen</i>
                                    </a>';
                            $edit = '<a href="'. route('admin.news.edit',$each->id) .'" type="button" class="btn btn-light btn-rounded">
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
        return view('backend.news.index');
    }

    public function create()
    {
        return view('backend.news.create');
    }

    public function store(StoreNews $request)
    {
        $fileName = null;
        if ($request->hasFile('image')) {
            $files = $request->file('image');
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $fileName = Str::random(5)."-".date('his')."-". Str::random(3).".".$extension;
                Storage::disk('public')->put('news/'.$fileName, file_get_contents($file));
            }
        }
        $data = new News();
        $data->title = $request->title;
        $data->news_category = $request->news_category;
        $data->body = $request->body;
        $data->image = $fileName;
        $data->save();

        return redirect()->route('admin.news.index')->with('create', 'Created Successfully');
    }

    public function edit($id)
    {
        $data = News::findOrFail($id);
        return view('backend.news.edit', compact('data'));
    }

    public function update($id, UpdateNews $request)
    {
        $data = News::findOrFail($id);

        $fileName = $data->image;
        if ($request->hasFile('news_img')) {
            Storage::disk('public')->delete('news/'.$fileName);
            $files = $request->file('news_img');
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $fileName = Str::random(5)."-".date('his')."-". Str::random(3).".".$extension;
                Storage::disk('public')->put('news/'.$fileName, file_get_contents($file));
            }
        }
        $data->title = $request->title;
        $data->news_category = $request->news_category;
        $data->body = $request->body;
        $data->image = $fileName;
        $data->update();
        return redirect()->route('admin.news.index')->with('update', 'Successfully Updated');
    }

    public function show($id)
    {
        $data = News::findOrFail($id);
        return view('backend.news.edit', compact('data'));
    }

    public function destroy($id)
    {
        $data = News::findOrFail($id);
        Storage::disk('public')->delete('news/'.$data->images);
        $data->delete();
    }
}
