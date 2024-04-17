<?php

namespace Tests\Feature\Videos;

use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


/**
 * Class VideoTest
 * @covers  \App\Http\Controllers\VideosController
 */
class VideoTest extends TestCase
{
    use RefreshDatabase;        //ESTAT PRECONEGUT -> ZERO STATE

    /**
     * @test
     */
    public function users_can_view_videos()
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

        $response = $this->get('/videos/' . $video->id); // 'videos/1' -> 'videos/{video}' -> 'videos/1'

        $response->assertStatus(200);
        $response->assertSee('Ubuntu 101');
        $response->assertSee('Here description');
        $response->assertSee('13 de desembre de 2020');

        }

    /**
     * @test
     */
    public function users_cannot_view_not_existing_videos()
    {


        $response = $this->get('/videos/999'); // 'videos/1' -> 'videos/{video}' -> 'videos/1'

        $response->assertStatus(404);
        $response->assertSee('Not Found');
    }
}
