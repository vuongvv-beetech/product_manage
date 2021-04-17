<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{  
    /**
     *  change language
     * 
     * @param string $locale
     * 
     * @return Response
     */ 
    public function changeLanguage($locale)
    {
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();

    } 
}
