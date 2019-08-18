<?php

Route::group(['middleware' => ['web', 'generic_crud']], function () {
  Route::resource('users', '\PatilVishalVS\GenericCRUD\Controllers\UserController');
  Route::resource('roles', '\PatilVishalVS\GenericCRUD\Controllers\RoleController');
  Route::resource('permissions', '\PatilVishalVS\GenericCRUD\Controllers\PermissionController');
});