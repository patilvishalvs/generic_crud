@extends('layouts.app')
@section('header')
{!! $page_title !!}
@endsection
@section('content')
  {!! Form::model($record, ['route' => [$route.'.update', $record['id']], 'method' => 'PUT']) !!}
    @include('vendor.generic.form', [
      'record' => $record,
      'form_fields' => $form_fields,
    ])
    {{Form::submit('Save', ['class' => 'btn btn-success'])}}
  {!! Form::close() !!}
@endsection