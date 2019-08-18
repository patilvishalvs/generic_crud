<?php
namespace PatilVishalVS\GenericCRUD\seeds;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder {

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    DB::table('users')->insert([
      'id' => 1,
      'name' => 'Administrator',
      'email' => 'admin@localhost',
      'password' => bcrypt('password'),
    ]);
  }

}
