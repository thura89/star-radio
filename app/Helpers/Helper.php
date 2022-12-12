<?php
namespace App\Helpers;

class Helpers{
    
    public static function news_images($media){
        if($media){
            return 'wwww';
        }else{
            return 'https://'.config('services.imgix.domain').'/common/dummy_square.png';
        }
    }
}