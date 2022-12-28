<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Ads;
use App\Models\News;
use App\Models\Event;
use App\Models\Noble;
use App\Models\Slider;
use App\Models\Program;
use App\Models\SongRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class HomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = Program::with('category')->latest()->get();
        // 1 =  Trending
        $trending_programs = Program::where('trending', 1)->with('category')->take('6')->latest()->get();
        $categories = Category::with('programs')->latest()->get();
        $all_news = News::take('4')->latest()->get();
        $news = News::whereIn('news_category',[1,2])->latest()->get();
        $other_news = News::whereIn('news_category',[3,4,5,6])->latest()->get();
        $events = Event::latest()->get();
        $noble = Noble::latest()->get();
        $ads = Ads::latest()->get();
        $song_requests = SongRequest::get();
        $sliders = Slider::where('status',1)->take(3)->latest('updated_at')->get();
        return view('frontend.web.index',compact('all_news','categories','programs','news','other_news','events','noble','ads','sliders','song_requests','trending_programs'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function news()
    { 
        $news = News::whereIn('news_category',[1,2])->latest()->get();
        $local_news = News::where('news_category',1)->latest()->get();
        $internatioal_news = News::where('news_category',2)->latest()->get();
        return view('frontend.web.news',compact('news','local_news','internatioal_news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
