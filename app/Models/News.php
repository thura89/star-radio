<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    public function news_img_path()
    {
        if ($this->image) {
            return asset('storage/news/'.$this->image);
        }
        return null;
    }
    
}
