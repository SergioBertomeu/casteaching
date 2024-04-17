<?php

namespace Tests\Feature\Videos;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class VideosManageControllerTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function superadmins_can_manage_videos(): void
    {

        $this->loginAsSuperAdmin();

        $response = $this->get('/manage/videos');

        $response->assertStatus(200);
        $response->assertViewIs('manage.videos.index');
    }

    /** @test */
    public function regular_users_cannot_manage_videos(): void
    {
        $this->loginAsRegularUser();
        $response = $this->get('/manage/videos');

        $response->assertStatus(403);
    }


    /** @test */
    public function guest_users_cannot_manage_videos(): void
    {

        $response = $this->get('/manage/videos');

        $response->assertStatus(route('login'));
    }


    /** @test */

    public function user_with_permissions_can_manage_videos(): void
    {
        $this->loginAsVideoManager();
        $response = $this->get('/manage/videos');
        $response->assertStatus(200);
    }

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
