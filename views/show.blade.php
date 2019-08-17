@extends('layouts.app')
@section('header')
{{ $page_title }}
@endsection
@section('content')
{{ print_r($record) }}
@endsection