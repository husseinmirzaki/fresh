<?php

use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name'      => 'Hussein Mirzaki',
            'git_token' => env('GITHUB_TOKEN', 'aaaa'),
            'email'     => 'husseinmirzaki@gmail.com',
            'password'  => \Illuminate\Support\Facades\Hash::make('123456')
        ]);
    }
}
