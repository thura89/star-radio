<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    use HasFactory;

    public function audio_playlist_img_path()
    {
        if ($this->image) {
            return asset('storage/audios/image/'.$this->image);
        }
        return null;
    }
    public function audio_playlist_file_path()
    {
        if ($this->files) {
            return asset('storage/audios/audio_file/'.$this->files);
        }
        return null;
    }
}
