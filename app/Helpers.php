<?php

use App\Models\Team;
use App\Models\User;
use App\Models\Video;
use Carbon\Carbon;

if (!function_exists('create_default_user')) {
    function create_default_user()
    {
        try {


        Team::create([
            'name' => 'Sergio Team',
            'personal_team' => true,
            'user_id' => 1
        ]);
        } catch (\Exception $exception) {
            // do nothing
        }

        User::create([
            'name' => 'Sergio',
            'email' => 'del_riven@hotmail.com',
            'password' => bcrypt('12345678'),
            'current_team_id' => 1
        ]);
    }


}

    if (!function_exists('create_default_videos')) {
    function create_default_videos()
    {
    Video::create([
            'title' => 'Ubuntu 101',
            'description' => '# Here description',
            'url' => 'https://www.youtube.com/watch?app=desktop&v=w8j07_DBl_I&ab_channel=acacha-dev',
            'published_at' => Carbon::parse('December 13, 2020 8:00pm'),
            'previous' => null,
            'next' => null,
            'series_id' => 1
        ]);
    }
}



