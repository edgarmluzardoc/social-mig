<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    const DEFAULT_USERS_SEEDS = 3;
    const DEFAULT_USERS_PASSWORD = '123456';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creating Users
        for ($userNumber = 1; $userNumber <= self::DEFAULT_USERS_SEEDS; $userNumber++) {
            $user = new \App\User([
                'name' => "User #$userNumber",
                'email' => "user$userNumber@example.com",
                'password' => Hash::make(self::DEFAULT_USERS_PASSWORD)
            ]);
            $user->save();
        }
    }
}
