<?php

namespace Tests\Feature\Videos;

use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

/**
 * @covers \App\Http\Controllers\Videos\VideosManageController
 */

class VideosManageControllerTest extends TestCase
{
    use RefreshDatabase;

    public static function testedBy()
    {
        return VideosManageControllerTest::class;
    }


    /** @test */
    public function superadmins_can_manage_videos(): void
    {


        $this->loginAsSuperAdmin();

        $response = $this->get('/manage/videos');

        $response->assertStatus(500);
        $response->assertViewIs('videos.manage.index');
        $response->assertViewHas('Videos');
    }

    /** @test */
    public function regular_users_cannot_manage_videos(): void
    {
        $this->loginAsRegularUser();
        $response = $this->get('/manage/videos');

        $response->assertStatus(403);
    }


    /** @test */
    public function guest_users_cannot_manage_videos()
    {

        $response = $this->get('/manage/videos');

        $response->assertStatus(route('login'));
    }


    /** @test */
    public function user_with_permissions_can_manage_videos(): void
    {


        $this->loginAsVideoManager();


        $response = $this->get('/manage/videos');

       $videos = create_sample_videos();



        $response->assertStatus(200);

        $response->assertViewIs('videos.manage.index');
        $response->assertViewHas('Videos', function ($v) use ($videos) {
            return $videos->count() === $v->count() && get_class($videos) === Collection::class
                && get_class($videos[0]) === Video::class;

        });
    }


    /** @test */
    private function loginAsVideoManager(): void
    {
        Auth::login(create_video_manager_user());
    }
    private function loginAsSuperAdmin()
    {
        Auth::login(create_superadmin_user());
    }

    private function loginAsRegularUser()
    {
        Auth::login(create_regular_user());
    }
}
