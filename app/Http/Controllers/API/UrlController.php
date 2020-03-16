<?php

namespace App\Http\Controllers\API;

use App\Eloquent\Url;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUrlRequest;
use App\Http\Requests\UpdateUrlRequest;
use App\Http\Resources\UrlResource;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UrlResource::collection(auth()->user()->urls);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUrlRequest $request)
    {
        $long_url = $request->input('long_url');
        auth()->user()->urls()->create([
            'short_url' => Url::generateShortUrl(),
            'long_url' => $long_url,
        ]);
        return ['message' => 'Short url created.'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Eloquent\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function show(Url $url)
    {
        return new UrlResource($url);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Eloquent\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUrlRequest $request, Url $url)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Eloquent\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function destroy(Url $url)
    {
        //
    }
}
