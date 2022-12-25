<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }


    public function program_img_path()
    {
        if ($this->image) {
            return asset('storage/programs/image/'.$this->image);
        }
        return null;
    }
    public function program_audio_path()
    {
        if ($this->files) {
            return asset('storage/programs/audio_file/'.$this->files);
        }
        return null;
    }
}
