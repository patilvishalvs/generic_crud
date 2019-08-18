<?php
namespace PatilVishalVS\GenericCRUD\seeds;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder {

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    DB::table('permissions')->insert([
      'id' => 1,
      'name' => 'Administer Application Configuration',
      'slug' => 'admin.app.config',
    ]);
  }

}
