<?php

namespace PatilVishalVS\GenericCRUD\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

  protected $fillable = [
    'name',
    'slug',
  ];
  public $timestamps = false;

  public function permissions() {
    return $this->belongsToMany(Permission::class, 'roles_permissions');
  }

  public function scopeSearchName($query, $value) {
    if ($value)
      $query->where('name', 'LIKE', '%' . $value . '%');
  }
  
    public function scopeSearchPermissions($query, $value) {
      if ($value) {
        $query->whereHas('permissions', function($q) use($value) {
              $q->where('id', $value);
            });
      }
    }

}
