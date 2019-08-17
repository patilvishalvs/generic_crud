<?php

namespace PatilVishalVS\GenericCRUD\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
      'name',
      'slug',
    ];
}
