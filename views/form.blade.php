@include ('vendor.generic.components.errors') {{-- Including error file --}}
@foreach($form_fields as $field_name => $field)
  @include('vendor.generic.components.form.'.$field['type'], [
    'field_name' => $field_name,
    'field' => $field,
  ])
@endforeach