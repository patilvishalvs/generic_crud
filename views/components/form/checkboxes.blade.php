<div class="form-group">
  <div class="control-label {{ $field['label_attributes']['class'] }}">{{ $field['label'] }}</div>
  @foreach($field['options'] as $key => $value)
  <div class="form-check">
    {!! Form::checkbox($field_name.'[]', $key, null, [
      'id' => 'edit-'.$field_name.'-'.$key,
      'class' => 'form-check-input',
    ]) !!}
    {!! Form::label('edit-'.$field_name.'-'.$key, $value, ['class' => 'form-check-label']) !!}
  </div>
  @endforeach
</div>