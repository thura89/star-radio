<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;


    public function event_photo_path()
    {
        if ($this->event_photo) {
            return asset('storage/events/photo/'.$this->event_photo);
        }
        return null;
    }
    public function event_image_path()
    {
        if ($this->image) {
            return asset('storage/events/image/'.$this->image);
        }
        return null;
    }
}
