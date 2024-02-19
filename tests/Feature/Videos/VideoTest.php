<?php

namespace Tests\Feature\Videos;

use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VideoTest extends TestCase
{
    use RefreshDatabase;        //ESTAT PRECONEGUT -> ZERO STATE

    /**
     * @test
     */
    public function users_can_view_videos()
    {
        // FASE 1 -> Preparació -> Preparar
        // WISHFUL PROGRAMMING -> API
        // Laravel eloquent -> https://laravel.com/docs/8.x/eloquent
         $video = Video::create([
            'title' => 'Ubuntu 101',
            'description' => '# Here description',
            'url' => 'https://www.youtube.com/watch?app=desktop&v=w8j07_DBl_I&ab_channel=acacha-dev',
            'published_at' => Carbon::parse('December 13, 2020 8:00pm'),
            'previous' => null,
            'next' => null,
            'series_id' => 1
        ]);


        // FASE 2 -> Execució -> Executar el codi a provar
        // Laravel HTTP TESTS -> https://laravel.com/docs/8.x/http-tests
        //dd('/videos/' . $video->id); // 'videos/1' -> 'videos/{video}' -> 'videos/1'
        $response = $this->get('/videos/' . $video->id); // 'videos/1' -> 'videos/{video}' -> 'videos/1'



        // FASE 3 -> Assertions -> Comprovacions

        $response->assertStatus(200);
        $response->assertSee('Ubuntu 101');
        $response->assertSee('Here description');
        $response->assertSee('December 13');

        }

}
