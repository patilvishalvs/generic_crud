<?php

namespace PatilVishalVS\GenericCRUD\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GenericController extends Controller {

  protected $model;
  protected $object;
  protected $singular_name;
  protected $plural_name;
  protected $model_label = 'id';
  protected $view = 'generic';
  protected $route;
  protected $fields_config = [];
  protected $with = [];

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $records = $this->model::with($this->with)->paginate(50);
    $datagrid = $this->fields_config['datagrid'];
    $datagrid['headers']['actions'] = [
      'title' => 'Actions',
      'links' => [
        'show' => [
          'class' => 'btn-sm btn-info',
          'title' => 'View',
          'route' => $this->route . '.show',
        ],
        'edit' => [
          'class' => 'btn-sm btn-primary',
          'title' => 'Edit',
          'route' => $this->route . '.edit',
        ],
        'delete' => [
          'class' => 'btn-sm btn-danger',
          'title' => 'Delete',
          'route' => $this->route . '.delete',
        ],
      ]
    ];
    $singular_name = $this->singular_name;
    $page_title = $this->plural_name;
    return view($this->view . '.index', compact(
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
    $this->setObject($id);
    $record = $this->object;
    $page_title = "{$this->singular_name}: ({$this->object[$this->model_label]})";
    return view($this->view . '.show', compact('record', 'page_title'));
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
    $this->setObject($id);
    $title = $this->object[$this->model_label];
    $this->object->delete();
    return redirect()->route($this->route . '.index')
            ->with('message', $this->singular_name . '(' . $title . ') successfully deleted!');
  }

  public function delete($id) {
    $this->setObject($id);
    $page_title = "{$this->singular_name}: ({$this->object[$this->model_label]})";
    $route = $this->route;
    return view($this->view . '.delete', compact('id', 'page_title', 'route'));
  }

  protected function setObject($id = false) {
    $model = $this->model;
    if ($id === false) {
      $this->object = new $model;
    }
    else {
      $this->object = $model::with($this->with)->findOrFail($id);
    }
  }

}
