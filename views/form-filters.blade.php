{!! Form::open(['route' => $route.'.index', 'method' => 'get']) !!} 
<div class="form-row">
  @foreach($datagrid['filters'] as $filter_name => $filter_field)
  <div class="col-md-2">
    @php
      $filter_field['label_attributes']['class'] = 'col-form-label-sm';
      $filter_field['attributes']['class'] .= ' form-control-sm';
    @endphp
    @include('vendor.generic.components.form.'.$filter_field['type'], [
      'field_name' => $filter_name,
      'field' => $filter_field,
      'value' => $filters[$filter_name] ?? '',
    ])
  </div>
  @endforeach
  <div class="col-md-2">
    {{Form::submit('Filter', ['class' => 'btn-mt-custom-filter btn btn-sm btn-info'])}}
  </div>
</div>
{!! Form::close() !!}