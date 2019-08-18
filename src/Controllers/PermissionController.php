<?php

namespace PatilVishalVS\GenericCRUD\Controllers;

use PatilVishalVS\GenericCRUD\Controllers\GenericController;

class PermissionController extends GenericController {

  public function __construct() {
    $this->route = 'permissions';
    $this->singular_name = 'Permission';
    $this->plural_name = 'Permissions';
    $this->model_label = 'name';
    $this->model = 'PatilVishalVS\GenericCRUD\Models\Permission';
    $this->fields_config = [
      'datagrid' => [
        'headers' => [
          'name' => 'Name',
          'name' => 'Name',
          'slug' => 'Slug',
        ],
        'filters' => [
          'name' => [
            'label' => 'Name',
            'type' => 'text',
            'attributes' => [
              'id' => 'filter-name',
              'class' => 'form-control',
              'placeholder' => 'Enter name...',
            ],
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
          'validate' => 'required|regex:/^[a-z0-9_\.]+$/',
        ],
      ],
      'view_fields' => [
        'name' => 'Name',
        'slug' => 'Slug',
      ],
    ];
  }

}
