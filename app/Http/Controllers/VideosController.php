<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function show($id)
    {
//        return 'videos.show | Video 1 description | December 13';

//    $video = new stdclass();
//    $video->title = 'Ubuntu 101';
//    $video->description = 'Here description';
//    $video->url = 'https://www.youtube.com/watch?app=desktop&v=w8j07_DBl_I&ab_channel=acacha-dev';
//    $video->published_at = 'December 13, 2020 8:00pm';

        return view('videos.show', [
            'video' => Video::find($id)

    ]); // CRUD -> RETRIEVE -> només un vídeo
    }
}
