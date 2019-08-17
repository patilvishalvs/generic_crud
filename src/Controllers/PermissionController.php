<?php

namespace PatilVishalVS\GenericCRUD\Controllers;

use PatilVishalVS\GenericCRUD\Controllers\GenericController;

class PermissionController extends GenericController
{
    public function __construct(){
      $this->route = 'permissions';
      $this->singular_name = 'Permission';
      $this->plural_name = 'Permissions';
      $this->model = 'PatilVishalVS\GenericCRUD\Models\Permission';
      $this->fields_config = [
        'datagrid' => [
          'headers' => [
            'name' => 'Name',
            'name' => 'Name',
            'slug' => 'Slug',
          ]
        ]
      ];
    }
}
