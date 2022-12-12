<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noble extends Model
{
    use HasFactory;

    public function nobles_img_path()
    {
        if ($this->image) {
            return asset('storage/nobles/image/'.$this->image);
        }
        return null;
    }
    public function nobles_file_path()
    {
        if ($this->download_file) {
            return asset('storage/nobles/file/'.$this->download_file);
        }
        return null;
    }
}
