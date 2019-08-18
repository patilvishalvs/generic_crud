@extends('layouts.app')
@section('header')
{!! $page_title !!}
@endsection
@section('content')
{!! Form::model($record, ['route' => $route.'.index']) !!}
    @include('vendor.generic.form', [
      'record' => $record,
      'form_fields' => $form_fields,
    ])
    {{Form::submit('Save', ['class' => 'btn btn-success'])}}
{!! Form::close() !!}
@endsection