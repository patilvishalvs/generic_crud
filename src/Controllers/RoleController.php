<?php

namespace PatilVishalVS\GenericCRUD\Controllers;

use PatilVishalVS\GenericCRUD\Controllers\GenericController;

class RoleController extends GenericController
{
    public function __construct(){
      $this->route = 'roles';
      $this->singular_name = 'Role';
      $this->plural_name = 'Roles';
      $this->model = 'PatilVishalVS\GenericCRUD\Models\Role';
      $this->model_label = 'name';
      $this->fields_config = [
        'datagrid' => [
          'headers' => [
            'name' => 'Name',
            'slug' => 'Slug',
            'permissions' => [
              'title' => 'Permissions',
              'template' => 'generic.components.list',
              'column' => 'name',
            ],
          ]
        ]
      ];
    }
}
