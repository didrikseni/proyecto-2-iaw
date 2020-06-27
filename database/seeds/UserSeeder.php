<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'admin',
            'email' => 'portaluns@gmail.com',
            'password' => Hash::make('a9g238fu')
        ));

        App\User::create(array(
            'name' => 'Test',
            'email' => 'test@test.com',
            'password' => Hash::make('test1234'),
        ));

        App\User::create(array(
            'name' => 'Juan',
            'email' => 'juan@test.com',
            'password' => Hash::make('test1234'),
        ));

        App\User::create(array(
            'name' => 'Sofia',
            'email' => 'sofia@test.com',
            'password' => Hash::make('test1234'),
        ));

        factory(\App\User::class, 15)->create();

    }
}
