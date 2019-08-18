<?php

namespace PatilVishalVS\GenericCRUD\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class GenericController extends Controller {

  protected $model;
  protected $object;
  protected $singular_name;
  protected $plural_name;
  protected $model_label = 'id';
  protected $view = 'vendor.generic';
  protected $route;
  protected $fields_config = [];
  protected $with = [];

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request) {
    $route = $this->route;
    $datagrid = $this->fields_config['datagrid'];
    $datagrid['headers']['actions'] = [
      'title' => 'Actions',
      'links' => [
        'show' => [
          'class' => 'btn-sm btn-info',
          'title' => 'View',
          'route' => $route . '.show',
        ],
        'edit' => [
          'class' => 'btn-sm btn-primary',
          'title' => 'Edit',
          'route' => $route . '.edit',
        ],
        'delete' => [
          'class' => 'btn-sm btn-danger',
          'title' => 'Delete',
          'route' => $route . '.delete',
        ],
      ]
    ];
    $singular_name = $this->singular_name;
    $page_title = $this->plural_name;
    $result = $this->filter($request, $datagrid);
    extract($result);
    return view($this->view . '.index', compact(
            'records', 'datagrid', 'singular_name', 'page_title', 'route', 'filters'
    ));
  }
  
  protected function filter(Request $request, $datagrid){
    $filters = [];
    $records = $this->model::with($this->with);
    foreach($datagrid['filters'] as $filter_name => $filter){
      if ($request->has($filter_name)) {
        $search_method = 'search'.ucfirst($filter_name);
        $records->$search_method($request->input($filter_name));
      }
    }
    $filters = $request->only(array_keys($datagrid['filters']));
    $records = $records->orderBy('id', 'DESC')->paginate(50);
    return ['records' => $records, 'filters' => $filters];
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    $this->setObject();
    $record = $this->object;
    $page_title = "Create {$this->singular_name}";
    $route = $this->route;
    $form_fields = $this->setLabelClass($this->fields_config['form_fields']); 
    return view($this->view . '.create', compact('record', 'page_title', 'route', 'form_fields'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    $this->save($request, 'store', false);
    $title = $this->object[$this->model_label];
    return redirect()->route($this->route . '.index')
            ->with('message', $title . '(' . $this->singular_name . ') successfully added!');
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
    $page_title = "{$this->singular_name}: <em>{$this->object[$this->model_label]}</em>";
    $view_fields = $this->fields_config['view_fields'];
    return view($this->view . '.show', compact('record', 'page_title', 'view_fields'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    $this->setObject($id);
    $record = $this->object;
    $page_title = "Edit {$this->singular_name}: <em>{$this->object[$this->model_label]}</em>";
    $route = $this->route;
    $form_fields = $this->setLabelClass($this->fields_config['form_fields'], 'update');    
    return view($this->view . '.edit', compact('record', 'page_title', 'route', 'form_fields'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
    $this->save($request, 'update', $id);
    $title = $this->object[$this->model_label];
    return redirect()->route($this->route . '.index')
            ->with('message', $title . '(' . $this->singular_name . ') successfully updated!');
  }
  
  protected function save(Request $request, $method, $id = false){
    $this->setObject($id);
    $except = array_merge(['_token'], $this->with);
    
    $validate = [];
    foreach($this->fields_config['form_fields'] as $field_name => $field){
      if(isset($field['validate'])){
        $validate[$field_name] = is_array($field['validate']) ? $field['validate'][$method] : $field['validate'];
        if(strpos($validate[$field_name], 'nullable') !== false && empty($request->input($field_name))){
          $except[] = $field_name;
        }
      }
    }
    $request->validate($validate);
    
    $fill = $request->except($except);
    $this->object->fill($fill)->save();
    foreach($this->with as $with){
      $with_values = $request->input($with);
      $this->object->$with()->sync($with_values);
    }
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
            ->with('message', $title . '(' . $this->singular_name . ') successfully deleted!');
  }

  public function delete($id) {
    $this->setObject($id);
    $page_title = "{$this->singular_name}: <em>{$this->object[$this->model_label]}</em>";
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

  protected function setLabelClass($form_fields, $method = 'store'){
    foreach($form_fields as &$form_field){
      $form_field['label_attributes']['class'] = '';
      if(isset($form_field['validate'])){
        $form_field['validate'] = is_array($form_field['validate']) ? $form_field['validate'][$method] : $form_field['validate'];
        if(isset($form_field['validate']) && strpos($form_field['validate'], 'required') !== false){
          $form_field['label_attributes']['class'] = 'required';
        }
      }
    }
    return $form_fields;
  }
}
