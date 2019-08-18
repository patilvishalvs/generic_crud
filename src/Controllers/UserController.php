<?php

namespace PatilVishalVS\GenericCRUD\Controllers;

use PatilVishalVS\GenericCRUD\Controllers\GenericController;
use PatilVishalVS\GenericCRUD\Models\Role;

class UserController extends GenericController {

  public function __construct() {
    $this->route = 'users';
    $this->singular_name = 'User';
    $this->plural_name = 'Users';
    $this->model = 'App\User';
    $this->model_label = 'name';
    $this->with = ['roles'];
    $roles = Role::pluck('name', 'id');
    $this->fields_config = [
      'datagrid' => [
        'headers' => [
          'name' => 'Name',
          'email' => 'Email',
          'roles' => [
            'title' => 'Roles',
            'template' => 'vendor.generic.components.list',
            'column' => 'name',
          ],
          'created_at' => 'Created At',
          'updated_at' => 'Updated At',
        ],
      ],
      'form_fields' => [
        'name' => [
          'label' => 'Name',
          'type' => 'text',
          'attributes' => [
            'id' => 'edit-name',
            'class' => 'form-control',
            'placeholder' => 'Enter name...',
          ],
          'validate' => 'required|max:100',
        ],
        'email' => [
          'label' => 'Email',
          'type' => 'email',
          'attributes' => [
            'id' => 'edit-email',
            'class' => 'form-control',
            'placeholder' => 'Enter email...',
          ],
          'validate' => 'required|email',
        ],
        'roles' => [
          'label' => 'Roles',
          'type' => 'checkboxes',
          'options' => $roles,
          'validate' => 'required',
        ],
        'password' => [
          'label' => 'Password',
          'type' => 'password',
          'attributes' => [
            'id' => 'edit-password',
            'class' => 'form-control',
            'placeholder' => 'Enter password...',
          ],
          'validate' => [
            'store' => 'required|min:3|confirmed',
            'update' => 'nullable|min:3|confirmed',
          ],
        ],
        'password_confirmation' => [
          'label' => 'Confirm Password',
          'type' => 'password',
          'attributes' => [
            'id' => 'edit-password-confirmation',
            'class' => 'form-control',
            'placeholder' => 'Enter password again...',
          ],
        ],
      ],
      'view_fields' => [
        'name' => 'Name',
        'email' => 'Email',
        'roles' => [
          'title' => 'Roles',
          'template' => 'vendor.generic.components.list',
          'column' => 'name',
        ],
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
      ],
    ];
  }

}
