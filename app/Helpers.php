<?php

use App\Models\Team;
use App\Models\User;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;


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


        $user=User::create([
            'name' => 'Sergio',
            'email' => 'del_riven@hotmail.com',
            'password' => bcrypt('12345678'),
            'current_team_id' => 1
        ]);
        add_personal_team($user);
        $user->superadmin = true;
        $user->save();


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

if (!function_exists('create_regular_user')) {
    function create_regular_user()

{
    $user = User::create([
        'name' => 'Pepe Pringao',
        'email' => 'pringao@iesebre.com',
        'password' => Hash::make('12345678'),

    ]);

    add_personal_team($user) ;
    return $user;
}

}

if (!function_exists('create_video_manager_user')) {
    function create_video_manager_user()
    {

        $user = User::create([
            'name' => 'VideoManager',
            'email' => 'videosmanager@iesebre.com',
            'password' => Hash::make('12345678')
        ]);
        Permission::create(['name' => 'videos_manage_index']);
        $user->givePermissionTo('videos_manage_index');
        add_personal_team($user);
        dd(Team::all());
        return $user;
    }
}
if (!function_exists('add_personal_team')) {

    /**
     * @param $user
     */
    function add_personal_team($user): void
    {
        try {
            Team::forceCreate([
                'name' => 'Sergio Team',
                'personal_team' => true,
                'user_id' => $user->id
            ]);
        } catch (\Exception $exception) {

            // do nothing
        }
    }
}









if (!function_exists('create_superadmin_user')) {
    function create_superadmin_user()
    {
       $user = User::create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@iesebre.com',
            'password' => Hash::make('12345678'),

        ]);
        $user->superadmin = true;
        $user->save();
        add_personal_team($user);
        return $user;
    }
}
if (!function_exists('define_gates')) {
    function define_gates(){

        Gate::before(function (User $user, $ability) {
            if ($user->isSuperAdmin()) {
                return true;
            }
        });
    }
}


if (!function_exists('create_permission')) {
    function create_permission()
    {
        Permission::create(['name' => 'videos_manage_index']);


    }

}







