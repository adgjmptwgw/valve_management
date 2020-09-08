@extends('layouts.app')
@section('content')

@include('common.errors')

<div id="app">
  <div>
    <router-link to="/T1">T-1系統線図
    </router-link>
  </div>

  <div>
    <router-view />
  </div>
</div>

<!-- 以下はデータベースから取得したデータを経由する処理 -->
<!-- *流れ*  DB → ValveController → 系統線図リスト → 各系統図にデータを渡す -->

<div id="app">
  <T1 :T1="{{ $ValveOptions }}"></T1>
</div>

@endsection