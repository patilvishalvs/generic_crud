<?php

namespace PatilVishalVS\GenericCRUD\Models;

use Illuminate\Database\Eloquent\Model;
use PatilVishalVS\GenericCRUD\Models\Role;

class Permission extends Model {

  protected $fillable = [
    'name',
    'slug',
  ];
  public $timestamps = false;

  public function roles() {
    return $this->belongsToMany(Role::class, 'roles_permissions');
  }

  public function scopeSearchName($query, $value) {
    if ($value)
      $query->where('name', 'LIKE', '%' . $value . '%');
  }

}
