@extends('layouts.app')
@section('content')

@include('common.errors')
<div id="app">
  <div>
    <router-link to="/SystemList">系統図リスト</router-link>
  </div>

  <div>
    <router-view />
  </div>
</div>

@endsection