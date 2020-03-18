<?php

namespace App\Http\Controllers;

use App\Eloquent\Url;
use Illuminate\Support\Facades\Request;

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

            // save details of the click
            $url->urlClicks()->create([
                'ip' => Request::server('REMOTE_ADDR'),
                'referer' => Request::server('HTTP_REFERER'),
                'user_agent' => Request::server('HTTP_USER_AGENT'),
            ]);

            // count click
            $url->total_click = $url->total_click + 1;
            $url->save();

            return redirect()->away($url->long_url);
        }

        return view('index');
    }
}
