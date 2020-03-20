<?php

namespace Tests\Feature;

use App\Eloquent\Url;
use App\Eloquent\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class UrlsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test url listing
     *
     * @return void
     */
    public function testUrlListing()
    {
        $this->signInAsUser();

        $response = $this->get($this->apiPath('urls'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'title_original',
                    'short_url',
                    'short_url_full',
                    'long_url',
                    'total_click',
                    'date',
                    'dateTime',
                    'clicksFor30days',
                ]
            ]
        ]);
    }

    /**
     * Test store url
     *
     * @return void
     */
    public function testStoreUrl()
    {
        $this->signInAsUser();

        $response = $this->post($this->apiPath('urls'), [
            'long_url' => 'https://github.com/fzaninotto/Faker',
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    /**
     * Test show url
     *
     * @return void
     */
    public function testShowUrl()
    {
        $this->signInAsUser();

        $shortUrl = Url::generateShortUrl();
        $user = User::first();
        $url = $user->urls()->create([
            'short_url' => $shortUrl,
            'long_url' => 'https://github.com/fzaninotto/Faker',
        ]);

        $response = $this->get($this->apiPath('urls/' . $url->id));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'title_original',
                'short_url',
                'short_url_full',
                'long_url',
                'total_click',
                'date',
                'dateTime',
                'clicksFor30days',
            ]
        ]);
    }

    /**
     * Test update url
     *
     * @return void
     */
    public function testUpdateUrl()
    {
        $this->signInAsUser();

        $shortUrl = Url::generateShortUrl();
        $user = User::first();
        $url = $user->urls()->create([
            'short_url' => $shortUrl,
            'long_url' => 'https://github.com/fzaninotto/Faker',
        ]);

        $response = $this->patch($this->apiPath('urls/' . $url->id), [
            'title' => 'Github',
            'short_url' => $url->short_url,
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }
}
