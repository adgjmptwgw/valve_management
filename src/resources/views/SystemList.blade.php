@extends('layouts.app')
@section('content')

@include('common.errors')

<div id="app">
  <p>
    <router-link to="/T1">
      <base-list-btn>
        <template v-slot:btn-name>
          T-1 〇〇系統線図
        </template>
      </base-list-btn>
    </router-link>
  </p>

  <div>
    <router-view :T1="{{ $ValveOptions }}" />
  </div>

  <p>
    <router-link to="/T2">
      <base-list-btn>
        <template v-slot:btn-name>
          T-2 〇〇系統線図
        </template>
      </base-list-btn>
    </router-link>
  </p>
  <div>
    <router-view :T2="{{ $ValveOptions }}" />
  </div>
</div>


<!-- <div id="app2">
  @{{test}}
</div> -->

<!-- <script>
  new Vue({
    el: "#app2",
    data: {},
  });
</script> -->


@endsection

<style>

</style>