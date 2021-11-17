<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class,10)->create();
        DB::table('users')->insert([
            'name' => 'test',
            'email' => 'testaccount@gmail.com',
            'email_verified_at' => now(),
            'password' => 'testaccount',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            ]);
    }
}
