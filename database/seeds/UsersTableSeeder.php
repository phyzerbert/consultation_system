<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "admin";
        $user->email = "admin@consultant.com";
        $user->role_id = 1;
        $user->password = "$2y$10\$ghC0UzL6/mbHg5VhPfG/IuYdNCHcTgxOBwpLp40aRjYbYCQo.P1FG";
        $user->save();
    }
}
