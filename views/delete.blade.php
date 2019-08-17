@extends('layouts.app')
@section('header')
Are you sure to delete <em>{{ $page_title }}</em>?
@endsection
@section('content')
  {!! Form::open(['method' => 'DELETE', 'route' => [$route.'.destroy', $id]]) !!}
    <p class="lead">Performing this action cannot be undone.</p>
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
  {!! Form::close() !!}
@endsection