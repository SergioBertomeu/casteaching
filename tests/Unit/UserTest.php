<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function isSuperAdmin(): void
    {
        $user= User::create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@iesebre.com',
            'password' => Hash::make('12345678'),
            'superadmin' => true
        ]);
        $user->superadmin = true;
        $user->save();
        $this->assertTrue($user->isSuperAdmin(), true);
    }
}
