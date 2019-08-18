<div class="form-group">
  @include('vendor.generic.components.form.label')
  {{ Form::text($field_name, $value ?? null, $field['attributes']) }}
</div>