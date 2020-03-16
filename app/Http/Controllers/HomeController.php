<?php

namespace App\Http\Controllers;

use App\Eloquent\Url;
use App\Http\Resources\UrlResource;

class HomeController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        if ($url = Url::findByShortUrl($slug)->first()) {
            return redirect()->away($url->long_url);
        }

        return view('index');
    }
}
