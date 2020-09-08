@extends('layouts.app')
@section('content')

@include('common.errors')

<!-- <div id="app">
  <T1 :test="{{ $ValveOptions }}"></T1>
</div> -->


<div id="app">
  <div>
    <router-link to="/T1">T-1系統線図</T-1>
    </router-link>
  </div>

  <div>
    <router-view />
  </div>
</div>

@if (count($ValveOptions) > 0)
<div class="panel panel-default">
  <div class="panel-heading">系統全図 目次</div>
  <div class="panel-body">
    <table class="table table-striped valve-table">
      <!-- テーブルヘッダ -->
      <thead>
        <th>タービン</th>
      </thead>
      <!-- テーブル本体 -->
      <tbody>
        <!-- <T1> -->
          @foreach ($ValveOptions as $valve)
          <tr>
            <td class="table-text">
              <div id="app">
                <usually-close :option-id={{ $valve->id }}></usually-close>
              </div>
              <div>{{ $valve->id }}</div>
              <div>{{ $valve->valve_name }}</div>
            </td>
          </tr>
          @endforeach
        <!-- </T1> -->
      </tbody>
    </table>
  </div>
</div>
@endif


@endsection