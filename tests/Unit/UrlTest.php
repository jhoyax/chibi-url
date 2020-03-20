<?php

namespace Tests\Unit;

use App\Eloquent\Url;
use App\Eloquent\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UrlTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test generate short url
     *
     * @return void
     */
    public function testGenerateShortUrl()
    {
        $firstShortUrl = Url::generateShortUrl();
        $secondShortUrl = Url::generateShortUrl();

        $user = factory(User::class)->create();
        $user->urls()->create([
            'short_url' => $firstShortUrl,
            'long_url' => 'https://github.com/fzaninotto/Faker',
        ]);


        // check length
        $this->assertEquals(6, strlen($firstShortUrl));

        // check if generator is always unique
        $this->assertNotEquals($firstShortUrl, $secondShortUrl);
    }
}
