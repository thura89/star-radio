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
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $user = count(User::select('id')->get());
        $program = count(Program::select('id')->get());
        $news = count(News::whereIn('news_category', [1, 2])->get());
        $other_news = count(News::whereIn('news_category', [3, 4, 5, 6])->get());
        $event = count(Event::select('id')->get());
        $noble = count(Noble::select('id')->get());
        $ads = count(Ads::select('id')->get());
        $slider = count(Slider::select('id')->get());
        $song_requests = SongRequest::get();
        // return $user;
        return view('backend.dashboard.index', compact('user', 'program', 'news', 'other_news', 'event', 'noble', 'ads', 'slider', 'song_requests'));
    }

    public function change_password()
    {
        return 'here';
    }

    public function blogs(Request $request)
    {
        if ($request->path() == 'admin/about') {
            $data = Blog::findOrFail(1);
        } elseif ($request->path()  == 'admin/contact') {
            $data = Blog::findOrFail(2);
        } elseif ($request->path()  == 'admin/daily_schedule') {
            $data = Blog::findOrFail(3);
        }
        $decode_images = json_decode($data['image']);
        $images = [];
        if ($request->path()  != 'admin/daily_schedule') {
            foreach ($decode_images as $key => $image) {
                $images[] = [
                    'id' => $image,
                    'src' => asset(config('const.blog_image_path')) . '/' . $image
                ];
            }
            $images = json_encode($images);
        }
        return view('backend.blogs.edit', compact('data', 'images'));
    }

    public function blog_store(Request $request, $id)
    {
        $data_result = Blog::findOrFail($id);

        if ($id == 3) {
            $collection = collect($request->program_name);
            $combined = $collection->combine($request->time);
            $data_result->body = json_encode(array_filter($combined->all()));
            $data_result->image = null;
        } else {
            $blog_photo_name = $data_result->image;
            if ($request->hasFile('image')) {
                Storage::disk('public')->delete('/blogs/image/' . $blog_photo_name);
                $files = $request->file('image');
                foreach ($files as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $blog_photo_name = uniqid() . '_' . time() . "." . $extension;
                    Storage::disk('public')->put('/blogs/image/' . $blog_photo_name, file_get_contents($file));
                }
            }

            /* Splice if not image  */
            if ($request->old || $request->photos) {
                $old_data = $request->old ?? [];
                $count = count($request->file('photos') ?? []);
                $data = array_reverse($old_data);
                $splice_data = array_splice($data, $count);

                /* Fetch Old Image */
                $store_data = json_decode($data_result->image);

                /* Diff image */
                $collection = collect($store_data);
                $diff_image = $collection->diff($splice_data);

                /* Delete image */
                if (!$diff_image->all() == []) {
                    foreach ($diff_image as $key => $diff) {
                        Storage::disk('public')->delete('/blogs/image/' . $diff);
                    }
                }

                /* Get Remain Data from coming form */
                foreach ($splice_data as $image) {
                    $data[] = $image;
                }

                /* Upload New image */
                if ($request->hasfile('photos')) {
                    foreach ($request->file('photos') as $image) {
                        $file_name = uniqid() . '_' . time() . '.' . $image->extension();
                        Storage::disk('public')->put('blogs/image/' . $file_name, file_get_contents($image));
                        $data[] = $file_name;
                    }
                }
                /* Splice No Need Data */
                $filtered = array_splice($data, $count);
                $data_result->image = json_encode($filtered);
            }

            $data_result->body = $request->body;
        }
        $data_result->title = $request->title;
        $data_result->update();
        return back()->with('update', 'Successfully Updated');
    }
}
