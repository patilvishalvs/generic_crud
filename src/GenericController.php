<?php

namespace PatilVishalVS\GenericCRUD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GenericController extends Controller {

  protected $model;
  protected $object;
  protected $id = false;
  protected $singular_name;
  protected $plural_name;
  protected $view = 'generic';
  protected $route;
  protected $fields_config = [];
  
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $records = $this->model::paginate(50);
    $datagrid = $this->fields_config['datagrid'];
    $datagrid['headers']['actions'] = [
      'show' => [
        'class' => 'btn-info',
        'title' => 'View',
        'route' => $this->route.'.show',
      ],
      'edit' => [
        'class' => 'btn-primary',
        'title' => 'Edit',
        'route' => $this->route.'.edit',
      ],
      'delete' => [
        'class' => 'btn-danger',
        'title' => 'Delete',
        'route' => $this->route.'.delete',
      ],
    ];
    $singular_name = $this->singular_name;
    $page_title = $this->plural_name;
    return view($this->view.'.index', compact(
        'records', 'datagrid', 'singular_name', 'page_title'
    ));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    //
  }
  
  public function delete($id){
    $page_title = $this->singular_name;
    $route = $this->route;
    return view($this->view.'.delete', compact('id', 'page_title', 'route'));
  }

  protected function setObject() {
    $model = $this->model;
    if ($this->id === false) {
      $this->object = new $model;
    }
    else {
      $this->object = $model::find($this->id);
    }
  }

}
