<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    public function blog_image_path()
    {
        if ($this->image) {
            return asset('storage/blogs/image/'.$this->image);
        }
        return null;
    }
}
