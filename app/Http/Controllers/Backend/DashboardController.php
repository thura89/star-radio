<?php

namespace App\Http\Controllers\Backend;

use App\Models\Ads;
use App\Models\Blog;
use App\Models\News;
use App\Models\User;
use App\Models\Event;
use App\Models\Noble;
use App\Models\Slider;
use App\Models\Program;
use App\Models\SongRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = count(User::select('id')->get());
        $program = count(Program::select('id')->get());
        $news = count(News::whereIn('news_category',[1,2])->get());
        $other_news = count(News::whereIn('news_category',[3,4,5,6])->get());
        $event = count(Event::select('id')->get());
        $noble = count(Noble::select('id')->get());
        $ads = count(Ads::select('id')->get());
        $slider = count(Slider::select('id')->get());
        $song_requests = SongRequest::get();
        // return $user;
        return view('backend.dashboard.index',compact('user','program','news','other_news','event','noble','ads','slider','song_requests'));
    }

    public function change_password()
    {
        return 'here';
    }

    public function about()
    {
        $data = Blog::findOrFail(1);
        return view('backend.blogs.edit',compact('data'));
    }

    public function contact()
    {
        $data = Blog::findOrFail(2);
        return view('backend.blogs.edit',compact('data'));
    }

    public function blog_store(Request $request, $id)
    {
        $data = Blog::findOrFail($id);
        $data->title = $request->title;
        $data->body = $request->body;
        $data->update();
        return redirect()->route('admin.dashboard')->with('update', 'Successfully Updated');
    }

}
