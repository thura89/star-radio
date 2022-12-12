<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;

    public function ads_img_path()
    {
        if ($this->image) {
            return asset('storage/ads/'.$this->image);
        }
        return null;
    }
}
