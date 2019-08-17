<?php

use Illuminate\Database\Seeder;

class UserRolesPermissionsTableSeeder extends Seeder {

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    DB::table('role_permissions')->insert([
      'role_id' => 1,
      'permission_id' => 1,
    ]);
    DB::table('user_roles')->insert([
      'role_id' => 1,
      'user_id' => 1,
    ]);
  }

}
