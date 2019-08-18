<div class="form-group">
  @include('vendor.generic.components.form.label')
  {{ Form::select($field_name, $field['options'], $value ?? null, $field['attributes']) }}
</div>