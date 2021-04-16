<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("
            INSERT INTO `users` (`id`, `socialite_type`, `socialite_uid`, `name`, `email`, `mobile`, `division`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
            (1, 'kakao', '9999999999', '테스터', 'test@epiloum.net', '', NULL, NOW(), NULL, NOW(), NULL);
        ");
    }
}
