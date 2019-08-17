<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    \App\User::insert([
      'id' => 1,
      'name' => 'Administrator',
      'email' => 'admin@localhost',
      'password' => bcrypt('password'),
    ]);
  }

}
