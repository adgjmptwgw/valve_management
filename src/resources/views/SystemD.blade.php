@extends('layouts.app')
@section('content')

@include('common.errors')

<p>T-1系統図</p>


<!-- <div id="app">
  <usually-close :csrf="{{json_encode(csrf_token())}}"></usually-close>
</div> -->

<!-- ---------------表示領域------------------>


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
        @foreach ($ValveOptions as $valve)
        <tr>
          <td class="table-text">
            <form action="{{ route('SystemD.update',$valve->id) }}" method="post">
              @csrf
              @method('PUT')

              <div id="app">
                <usually-close></usually-close>
              </div>
            </form>

            <div>{{ $valve->id }}</div>
            <div>{{ $valve->valve_name }}</div>
          </td>
          <!-- <td>
            <form action="{{ route('SystemD.edit',$valve->id) }}" method="GET">
              @csrf
              <button type="submit" class="btn btn-primary">更新</button>
            </form>
          </td> -->
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endif

@endsection