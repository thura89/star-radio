<?php
namespace App\Http\Helpers;

use App\Models\Ads;
use App\Models\Audio;
use App\Models\SongRequest;

class Helper{
    
    public static function news_images($media){
        if($media){
            return 'wwww';
        }else{
            return 'https://'.config('services.imgix.domain').'/common/dummy_square.png';
        }
    }

    public static function songRequestCount() {
        $data = SongRequest::whereNull('read_at')->get();
        return count($data);
    }

    public static function Ads() {
        $data = Ads::latest()->get();
        return $data;
    }

    public static function Radio() {
        $data = Audio::latest()->first();
        return $data;
    }
}