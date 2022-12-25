<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocalizationController extends Controller
{
    public function setlang($locale)
    {
        App::setLocale($locale);
        Session::put('locale',$locale);
        return redirect()->back();
    }

    public function homesetlang($locale)
    {
        App::setLocale($locale);
        $data = Session::put('locale',$locale);
        return $data;
    }
}
