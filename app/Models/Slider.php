<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    public function slider_front_img_path()
    {
        if ($this->front_image) {
            return asset('storage/sliders/front_image/'.$this->front_image);
        }
        return null;
    }

    public function slider_background_img_path()
    {
        if ($this->background_image) {
            return asset('storage/sliders/background_image/'.$this->background_image);
        }
        return null;
    }
}
