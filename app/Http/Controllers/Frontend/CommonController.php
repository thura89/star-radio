<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog;
use App\Models\News;
use App\Models\Event;
use App\Models\Noble;
use App\Models\SongRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSongRequest;

class CommonController extends Controller
{
    public function news($id)
    { 
        $news = News::where('news_category',$id)->latest()->paginate(5);
        return view('frontend.web.news',compact('news','id'));
    }

    public function show($id)
    { 
        $data = News::findOrFail($id);
        return view('frontend.web.news_show',compact('data'));
    }

    public function all_news()
    { 
        $id = null;
        $news = News::latest('updated_at')->paginate(5);
        return view('frontend.web.news',compact('news','id'));
    }

    public function events()
    { 
        $events = Event::latest('updated_at')->paginate(5);
        return view('frontend.web.events',compact('events'));
    }

    public function event_show($id)
    { 
        $data = Event::findOrFail($id);
        $images = json_decode($data['image']);
        return view('frontend.web.events_show',compact('data','images'));
    }

    public function nobles()
    { 
        $cate = null;
        $nobles = Noble::latest('updated_at')->paginate(6);
        return view('frontend.web.nobles',compact('nobles','cate'));
    }

    public function nobles_show($id)
    { 
        $data = Noble::findOrFail($id);
        return view('frontend.web.nobles_show',compact('data'));
    }

    public function noblesbycate($cate)
    { 
        $cate = $cate ?? null;
        $nobles = Noble::where('noble_category',$cate)->latest('updated_at')->paginate(6);
        return view('frontend.web.nobles',compact('nobles','cate'));
    }
    

    public function songRequest()
    {
        return view('frontend.web.song_request');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSongRequest(CreateSongRequest $request)
    {
        // return 'heree';
        $data = new SongRequest();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->songname = $request->songname;
        $data->artist = $request->artist;
        $data->message = $request->message;
        $data->save();
        return json_encode(array(
            "statusCode"=>200
        ));
    }

    public function about()
    {
        $data = Blog::findOrFail(1);
        return view('frontend.web.blog',compact('data'));
    }

    public function contact()
    {
        $data = Blog::findOrFail(2);
        return view('frontend.web.blog',compact('data'));
    }
    public function blogs(Request $request)
    {
        if ($request->path() == 'about') {
            $data = Blog::findOrFail(1);
        } elseif ($request->path()  == 'contact') {
            $data = Blog::findOrFail(2);
        } elseif ($request->path()  == 'daily_schedule') {
            $data = Blog::findOrFail(3);
        }
        $images = json_decode($data['image']);
        return view('frontend.web.blog',compact('data','images'));
    }
}
