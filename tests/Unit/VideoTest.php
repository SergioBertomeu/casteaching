<?php

namespace Tests\Unit;

use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideoTest extends TestCase
{
    use RefreshDatabase;
    /** @test */

    public function can_get_formatted_published_at_date(): void
    {
        $video = Video::create([
            'title' => 'Ubuntu 101',
            'description' => '# Here description',
            'url' => 'https://www.youtube.com/watch?app=desktop&v=w8j07_DBl_I&ab_channel=acacha-dev',
            'published_at' => Carbon::parse('December 13, 2020 8:00pm'),
            'previous' => null,
            'next' => null,
            'series_id' => 1
        ]);

        $dateToTest=  $video->formatted_published_at;

        $this->assertEquals($dateToTest,'13 de desembre de 2020');
    }

    /** @test */

    public function can_get_formatted_published_at_date_when_not_published(): void
    {
        $video = Video::create([
            'title' => 'Ubuntu 101',
            'description' => '# Here description',
            'url' => 'https://www.youtube.com/watch?app=desktop&v=w8j07_DBl_I&ab_channel=acacha-dev',
            'published_at' => null,
            'previous' => null,
            'next' => null,
            'series_id' => 1
        ]);

        $dateToTest=  $video->formatted_for_humans_published_at;

        $this->assertEquals($dateToTest,'');
    }
}
