@extends('layouts.app')
@section('content')

@include('common.errors')

<div id="app">
  <!-- 各系統線図へのリンクを記述 <router-link to=""> => router.js => 行先のコンポーネント -->
  <p>
    <router-link to="/SystemList">
      <!-- 各系統線図へアクセスする際のボタンコンポーネント。ボタンに系統線図名を表示する為、slotを使用。 -->
      <base-list-btn>
        <template v-slot:btn-name>
          目次
        </template>
      </base-list-btn>
    </router-link>

    <div>
      <!-- DB => ValveOptionController => このblade.php => 各系統線図へ$ValveOptionsとして弁のデータを送る -->
      <router-view :u1_t1="{{ $ValveData_U1_T1 }}" :u1_t2="{{ $ValveData_U1_T2 }}" :u1_b1="{{ $ValveData_U1_B1 }}" />
    </div>
  </p>
</div>

<!-- <input type="text" class="drag-and-drop" id="red-box"> -->

@endsection
<!-- ------------------------------------------------------------------------------ -->


<!-- <p class="test">
    <router-link to="/u1_t1">
      <base-list-btn>
        <template v-slot:btn-name>
          T-1 〇〇系統線図
        </template>
      </base-list-btn>
    </router-link>
  </p>

  <div>
    <router-view :u1_t1="{{ $ValveData_U1_T1 }}" />
  </div>


  <p>
    <router-link to="/u1_t2">
      <base-list-btn>
        <template v-slot:btn-name>
          T-2 〇〇系統線図
        </template>
      </base-list-btn>
    </router-link>
  </p>
  <div>
    <router-view :u1_t2="{{ $ValveData_U1_T2 }}" />
  </div> -->


<style>
  .drag-and-drop {
    cursor: move;
    position: absolute;
    z-index: 1000;
  }

  .drag {
    z-index: 1001;
  }
</style>