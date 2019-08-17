<?php
namespace PatilVishalVS\GenericCRUD;
use PatilVishalVS\GenericCRUD\Models\Role;

trait HasRolesTrait {
  public function roles() {
    return $this->belongsToMany(Role::class, 'user_roles');
  }
}