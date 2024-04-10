<?php

namespace Tests\Unit;

// Make sure to use Laravel's TestCase, not PHPUnit's
use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;


class HelperTest extends TestCase
{
    use refreshDatabase;
    /**
     * @test create_default_user
     */
    public function create_default_user()
    {
        // Assuming create_default_user is a function that seeds the database
        create_default_user();

        $this->assertDatabaseCount('users', 1);


        $this->assertDatabaseHas('users', [
            'name' => config('casteaching.default_user.name'),
            'email' => config('casteaching.default_user.email'),
        ]);

        $user = User::find(1);

        $this->assertNotNull($user);
        $this->assertEquals(config('casteaching.default_user.name'), $user->name);
        $this->assertEquals(config('casteaching.default_user.email'), $user->email);

//        $this->assertNotNull($user->current_team_id);
//        $this ->assertEquals(1, $user->current_team_id);
        $this->assertTrue(Hash::check(config('casteaching.default_user.password'), $user->password));

    }


    /**
     * @test create_default_video
     */
    public function create_default_videos()
    {
        // Assuming create_default_user is a function that seeds the database
        create_default_videos();

        $this->assertDatabaseCount('videos', 1);

        $this->assertDatabaseHas('videos', [
            'title' => 'Ubuntu 101',
            'description' => '# Here description',
        ]);




    }
}
