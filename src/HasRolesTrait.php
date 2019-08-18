<?php

namespace PatilVishalVS\GenericCRUD;

use PatilVishalVS\GenericCRUD\Models\Role;

trait HasRolesTrait {

  public function roles() {
    return $this->belongsToMany(Role::class, 'users_roles');
  }

  //HasPermissionsTrait.php
  public function hasPermissionThroughRole($permission) {
    foreach ($permission->roles as $role) {
      if ($this->roles->contains($role)) {
        return true;
      }
    }
    return false;
  }

  public function setPasswordAttribute($pass) {
    $this->attributes['password'] = bcrypt($pass);
  }

  public function scopeSearchName($query, $value) {
    if ($value)
      $query->where('name', 'LIKE', '%' . $value . '%');
  }

  public function scopeSearchEmail($query, $value) {
    if ($value)
      $query->where('email', 'LIKE', '%' . $value . '%');
  }

  public function scopeSearchRoles($query, $value) {
    if ($value) {
      $query->whereHas('roles', function($q) use($value) {
            $q->where('id', $value);
          });
    }
  }

}