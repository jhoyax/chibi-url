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
            'title' => $this->title ?: $this->long_url,
            'title_original' => $this->title,
            'short_url' => $this->short_url,
            'short_url_full' => config('app.url') . '/' . $this->short_url,
            'long_url' => $this->long_url,
            'total_click' => $this->total_click,
            'date' => $this->created_at->toFormattedDateString(),
            'dateTime' => $this->created_at->toDayDateTimeString(),
            'clicksFor30days' => $this->clicksFor30days(),
        ];
    }

    private function clicksFor30days()
    {
        $reports = [
            'labels' => [],
            'data' => [],
        ];
        for ($i=30; $i >= 0; $i--) {
            $currentDate = date('Y-m-d', strtotime('-' . $i . ' days'));
            array_push(
                $reports['labels'],
                $currentDate
            );
            array_push(
                $reports['data'],
                $this->urlClicks()->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") = "' . $currentDate . '"')->count()
            );
        }

        return $reports;
    }
}
