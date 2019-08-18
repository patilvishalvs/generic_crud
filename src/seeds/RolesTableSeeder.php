<?php
namespace PatilVishalVS\GenericCRUD\seeds;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder {

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    DB::table('roles')->insert([
      'id' => 1,
      'name' => 'Administrator',
      'slug' => 'administrator',
    ]);
  }

}
