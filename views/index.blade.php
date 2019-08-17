@extends('layouts.app')
@section('header', $page_title)
@section('content')
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
                    @php
                      $actioninfo['params']['id'] = $record['id']
                    @endphp
                    @actionlink($actioninfo)
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