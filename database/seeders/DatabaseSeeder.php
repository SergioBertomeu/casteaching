<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Team;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        create_default_user();

        create_superadmin_user();

        create_regular_user();

        create_video_manager_user();

        create_user_manager_user();

        create_default_videos();

        create_permission();

        create_sample_videos();

    }
}
