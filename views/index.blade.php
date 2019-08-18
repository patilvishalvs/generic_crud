@extends('layouts.app')
@section('header', $page_title)
@section('content')
@canany(['admin.app.config', $route.'.create'])
<div class="links text-right">
{{ link_to_route($route.'.create', "Add {$singular_name}", null, ['class' => 'btn btn-sm btn-success mb-2']) }}
</div>
@endcan
@if(Session::has('message'))    
<div class="alert alert-success">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <em> {!! session('message') !!}</em>
</div>
@endif 

<div class="table-responsive">
  <table class="table table-striped table-bordered" id="data-tables">
    <thead>
      <tr>
        @foreach($datagrid['headers'] as $col => $header)
        <th>{{ $header['title'] ?? $header }}</th>
        @endforeach
      </tr>
    </thead>
    <tbody>
      @if(!$records->isEmpty())
        @foreach($records as $record)
          <tr>
            @foreach($datagrid['headers'] as $key => $header)
              <td>
                @if($key == 'actions')
                  @foreach($header['links'] as $action => $actioninfo)
                    @canany(['admin.app.config', $actioninfo['route']])
                      @php
                        $actioninfo['params']['id'] = $record['id']
                      @endphp
                      @include('vendor.generic.components.action-link', $actioninfo)
                    @endcan
                  @endforeach
                @elseif(is_array($header) && isset($header['template']))
                  @include($header['template'], ['list' => $record[$key], 'column' => $header['column']])
                @else
                  {{ $record[$key] }}
                @endif
              </td>
            @endforeach
          </tr>
        @endforeach
      @else
        <tr>
          <td class="text-center" colspan="{{ count($datagrid['headers']) }}">
            No result found for <em>{{ $singular_name }}</em>
          </td>
        </tr>
      @endif
    </tbody>
  </table>
</div>
<div class="text-right">
  {{ $records->links() }}
</div>
@endsection