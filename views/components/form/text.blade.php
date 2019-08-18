<div class="form-group">
  @include('vendor.generic.components.form.label')
  {{ Form::text($field_name, null, $field['attributes']) }}
</div>