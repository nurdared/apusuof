<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Admin', 'email' => 'admin@admin.com', 'password' => '$2y$10$8QJnV5zKvfINZynMSWYjquikECzzBbEcMMrZOOnBzlli7jU2Ko/C2', 'role_id' => 1, 'remember_token' => '', 'username' => 'TP038114', 'avatar' => 'noimage.jpg', 'type' => 'admin', 'contact' => '6014', 'age' => '2019-05-05'],

        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}
