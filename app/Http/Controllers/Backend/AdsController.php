<?php

namespace App\Http\Controllers\Backend;

use App\Models\Ads;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAds;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Ads::query();
            return Datatables::of($data)
                        ->addIndexColumn()
                        ->editColumn('title',function($each){
                            return Str::limit($each->title,45,'...');
                        })
                        ->editColumn('image',function($each){
                            return '<div class="avatar avatar-lg avatar-4by3">
                                        <img src="'.$each->ads_img_path().'" alt="" class="avatar-img rounded">    
                                    </div>';
                        })
                        ->editColumn('status',function($each){
                            // Publish status = 1
                            if ($each->status == 1) {
                                return '<span class="btn btn-outline-success btn-rounded">'.config('const.ads_status.1').'</span>';
                            }else{
                                return '<span class="btn btn-outline-secondary btn-rounded">'.config('const.ads_status.0').'</span>';
                            }
                        }) 
                        ->editColumn('updated_at',function($each){
                            return Carbon::parse($each->created_at)->format('d-m-y H:i:s');
                        })
                        ->addColumn('action', function($each){

                            $info = '<a href="'. route('admin.ads.show',$each->id) .'" type="button" class="btn btn-info btn-rounded">
                                            <i class="material-icons">fullscreen</i>
                                    </a>';
                            $edit = '<a href="'. route('admin.ads.edit',$each->id) .'" type="button" class="btn btn-light btn-rounded">
                                            <i class="material-icons">edit</i>
                                    </a>';
                            $delete = '<a href="#" type="button" class="btn btn-danger btn-rounded delete" data-id="' . $each->id . '">
                                            <i class="material-icons">close</i>
                                        </a>';
                            $collect = $info.$edit.$delete;
                            $action = '<div class="button-list">'.$collect.'</div>';
                            return $action ;
                        })
                        ->rawColumns(['action','image','status'])
                        ->make(true);
        }
        return view('backend.ads.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAds $request)
    {
        // return $request->all();
        $image = null;
        if ($request->hasFile('image')) {
            $files = $request->file('image');
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $image = Str::random(5)."-".date('his')."-". Str::random(3).".".$extension;
                Storage::disk('public')->put('ads/'.$image, file_get_contents($file));
            }
        }
        $data = new Ads();
        $data->title = $request->title;
        $data->status = $request->status ?? '0';
        $data->image = $image;
        $data->save();

        return redirect()->route('admin.ads.index')->with('create', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function show(Ads $ads,$id)
    {
        $ads = Ads::findOrFail($id);
        return view('backend.ads.edit', compact('ads'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function edit(Ads $ads,$id)
    {
        $ads = Ads::findOrFail($id);
        return view('backend.ads.edit', compact('ads'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ads $ads,$id)
    {
        $data = Ads::findOrFail($id);
        $fileName = $data->image;
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete('ads/'.$fileName);
            $files = $request->file('image');
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $fileName = "ads_".Str::random(5)."-".date('his')."-". Str::random(3).".".$extension;
                Storage::disk('public')->put('ads/'.$fileName, file_get_contents($file));
            }
        }
        $data->title = $request->title;
        $data->status = $request->status ?? '0';
        $data->image = $fileName;
        $data->update();
        return redirect()->route('admin.ads.index')->with('update', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ads $ads,$id)
    {
        $data = Ads::findOrFail($id);
        Storage::disk('public')->delete('ads/'.$data->image);
        $data->delete();
    }
}
