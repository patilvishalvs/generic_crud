<?php

namespace PatilVishalVS\GenericCRUD\Controllers;

use PatilVishalVS\GenericCRUD\Controllers\GenericController;
use PatilVishalVS\GenericCRUD\Models\Permission;

class RoleController extends GenericController {

  public function __construct() {
    $this->route = 'roles';
    $this->singular_name = 'Role';
    $this->plural_name = 'Roles';
    $this->model = 'PatilVishalVS\GenericCRUD\Models\Role';
    $this->model_label = 'name';
    $this->with = ['permissions'];
    $premissions = Permission::pluck('name', 'id');
    $this->fields_config = [
      'datagrid' => [
        'headers' => [
          'name' => 'Name',
          'slug' => 'Slug',
          'permissions' => [
            'title' => 'Permissions',
            'template' => 'vendor.generic.components.list',
            'column' => 'name',
          ],
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
          'validate' => 'required',
        ],
        'slug' => [
          'label' => 'Slug',
          'type' => 'text',
          'attributes' => [
            'id' => 'edit-slug',
            'class' => 'form-control',
            'placeholder' => 'Enter slug...',
          ],
          'validate' => 'required|regex:/^[a-z0-9_]+$/',
        ],
        'permissions' => [
          'label' => 'Permissions',
          'type' => 'checkboxes',
          'options' => $premissions,
          'validate' => 'required',
        ],
      ],
    ];
  }

}
