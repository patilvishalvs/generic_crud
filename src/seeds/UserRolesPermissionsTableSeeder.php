<?php
namespace PatilVishalVS\GenericCRUD\seeds;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRolesPermissionsTableSeeder extends Seeder {

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    // Administrator Permissions
    DB::table('roles_permissions')->insert([
      'role_id' => 1,
      'permission_id' => 1,
    ]);

    // Administrator Role
    DB::table('users_roles')->insert([
      'role_id' => 1,
      'user_id' => 1,
    ]);
  }

}
