<?php

use Illuminate\Database\Seeder;
use App\Model\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::create([
        'name' => 'Toto',
        'email' => 'toto@email.com',
        'password' => bcrypt('password')
      ]);
      User::create([
        'name' => 'Admin',
        'email' => 'admin@email.com',
        'password' => bcrypt('admin')
      ]);
    }
}
