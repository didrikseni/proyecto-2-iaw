<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create(array(
            'name' => 'Test',
            'email' => 'test@test.com',
            'password' => \Illuminate\Support\Facades\Hash::make('test1234'),
        ));

        App\User::create(array(
            'name' => 'Juan',
            'email' => 'juan@test.com',
            'password' => \Illuminate\Support\Facades\Hash::make('test1234'),
        ));

        App\User::create(array(
            'name' => 'Sofia',
            'email' => 'sofia@test.com',
            'password' => \Illuminate\Support\Facades\Hash::make('test1234'),
        ));
    }
}
