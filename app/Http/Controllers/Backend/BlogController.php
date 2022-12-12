<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        // return Blog::all();
        if ($request->ajax()) {
            $data = Blog::query();
            return Datatables::of($data)
                        ->addIndexColumn()
                        ->editColumn('body',function($each){
                            return Str::limit($each->body,100,'...');
                        })

                        ->addColumn('action', function($row){

                            $edit = '<button type="button" class="btn btn-light btn-rounded">
                                            <i class="material-icons">edit</i>
                                    </button>';
                            $delete = '<button type="button" class="btn btn-danger btn-rounded">
                                            <i class="material-icons">close</i>
                                        </button>';
                            $collect = $edit.$delete;
                            $action = '<div class="button-list">'.$collect.'</div>';
                            
                            
                                return $action ;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
        }
        return view('backend.blogs.index');
    }

    public function create()
    {
        return view('backend.blogs.create');
    }

    public function store(Request $request)
    {
        # code...
    }

}
