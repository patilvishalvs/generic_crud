<?php

namespace PatilVishalVS\GenericCRUD\Controllers;

use PatilVishalVS\GenericCRUD\Controllers\GenericController;

class UserController extends GenericController
{
    public function __construct(){
      $this->route = 'users';
      $this->singular_name = 'User';
      $this->plural_name = 'Users';
      $this->model = 'App\User';
      $this->model_label = 'name';
      $this->with = ['roles'];
      $this->fields_config = [
        'datagrid' => [
          'headers' => [
            'name' => 'Name',
            'email' => 'Email',
            'roles' => [
              'title' => 'Roles',
              'template' => 'generic.components.list',
              'column' => 'name',
            ],
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
          ]
        ]
      ];
    }
}
