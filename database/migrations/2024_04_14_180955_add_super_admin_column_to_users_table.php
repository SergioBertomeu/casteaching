<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Laravel\Fortify\Fortify;

class AddSuperAdminColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('superadmin')
                ->after('remember_token')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('superadmin');
        });
//        Schema::table('users', function (Blueprint $table) {
//            $table->dropColumn(array_merge([
//                'superadmin',
//            ], Fortify::confirmsTwoFactorAuthentication() ? [
//                'two_factor_confirmed_at',
//            ] : []));
//        });
    }
};
