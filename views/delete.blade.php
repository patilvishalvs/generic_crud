@extends('layouts.app')
@section('header')
Are you sure to delete {!! $page_title !!}?
@endsection
@section('content')
  {!! Form::open(['method' => 'DELETE', 'route' => [$route.'.destroy', $id]]) !!}
    <p class="lead">Performing this action cannot be undone.</p>
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    {{ link_to(route($route.'.index'), 'Cancel') }}
  {!! Form::close() !!}
@endsection