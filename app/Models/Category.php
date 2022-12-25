<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function programs()
    {
        return $this->hasMany(Program::class,'category_id','id');

        // return $this->hasMany(Comment::class, 'foreign_key', 'local_key');
    }

    public function category_img_path()
    {
        if ($this->image) {
            return asset('storage/categories/'.$this->image);
        }
        return null;
    }
}
