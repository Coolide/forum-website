<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $test_user1 = new User;
        $test_user1->name = "John Smith";
        $test_user1->email = "john_smith@test.com";
        $test_user1->password = "test123";
        $test_user1->save();

        $test_user2 = new User;
        $test_user2->name = "Sara Hellen";
        $test_user2->email = "s_hellen@test.com";
        $test_user2->password = "abcdefg";
        $test_user2->save();

        User::factory()->count(10)->create();
    }
}
