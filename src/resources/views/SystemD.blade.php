@extends('layouts.app')
@section('content')

@include('common.errors')

<p>T-1系統図</p>


<!-- <div id="app">
  <usually-close :csrf="{{json_encode(csrf_token())}}"></usually-close>
</div> -->

<!-- ---------------表示領域------------------>

<!-- <div id="app">
  <div>
    <router-link to="/SystemList">系統図リスト</router-link>
  </div>

  <div>
    <router-view />
  </div>
</div> -->

@if (count($ValveOptions) > 0)
<div class="panel panel-default">
  <div class="panel-heading">タスクリスト</div>
  <div class="panel-body">
    <table class="table table-striped valve-table">
      <!-- テーブルヘッダ -->
      <thead>
        <th>タスク</th>
      </thead>
      <!-- テーブル本体 -->
      <tbody>
        <!-- <system-diagram> -->
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
        <!-- </system-diagram> -->
      </tbody>
    </table>
  </div>
</div>
@endif

@endsection