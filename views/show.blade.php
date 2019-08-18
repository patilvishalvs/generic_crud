@extends('layouts.app')
@section('header')
{!! $page_title !!}
@endsection
@section('content')
  @foreach($view_fields as $key => $view_field)
  <div class="form-group">
    <label class="font-weight-bold">{{ $view_field['title'] ?? $view_field }}</label>
    <div>
    @if(is_array($view_field) && isset($view_field['template']))
      @include($view_field['template'], ['list' => $record[$key], 'column' => $view_field['column']])
    @else
      {{ $record[$key] }}
    @endif
    </div>
  </div>
  @endforeach
@endsection