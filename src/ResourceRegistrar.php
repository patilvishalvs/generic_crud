<?php

namespace PatilVishalVS\GenericCRUD;

use Illuminate\Routing\ResourceRegistrar as OriginalRegistrar;

class ResourceRegistrar extends OriginalRegistrar {

  // add data to the array
  /**
   * The default actions for a resourceful controller.
   *
   * @var array
   */
  protected $resourceDefaults = ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy', 'delete'];

  /**
   * Add the data method for a resourceful route.
   *
   * @param  string  $name
   * @param  string  $base
   * @param  string  $controller
   * @param  array   $options
   * @return \Illuminate\Routing\Route
   */
  protected function addResourceDelete($name, $base, $controller, $options) {
    $uri = $this->getResourceUri($name) . '/{' . $base . '}/delete';
    $action = $this->getResourceAction($name, $controller, 'delete', $options);
    return $this->router->get($uri, $action);
  }

}