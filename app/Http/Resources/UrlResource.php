<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UrlResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title?:$this->long_url,
            'short_url' => $this->short_url,
            'short_url_full' => config('app.url') . '/' . $this->short_url,
            'long_url' => $this->long_url,
            'total_click' => $this->total_click,
            'date' => $this->created_at->toFormattedDateString(),
            'dateTime' => $this->created_at->toDayDateTimeString(),
        ];
    }
}
