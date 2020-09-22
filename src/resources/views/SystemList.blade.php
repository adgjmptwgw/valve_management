@extends('layouts.app')
@section('content')

@include('common.errors')

<div id="app">
  <!-- 各系統線図へのリンクを記述 <router-link to=""> => router.js => 行先のコンポーネント -->
  <p>
    <router-link to="/t1">
      <!-- 各系統線図へアクセスする際のボタンコンポーネント。ボタンに系統線図名を表示する為、slotを使用。 -->
      <base-list-btn>
        <template v-slot:btn-name>
          T-1 〇〇系統線図
        </template>
      </base-list-btn>
    </router-link>
  </p>

  <div>
    <!-- DB => ValveOptionController => このblade.php => 各系統線図へ$ValveOptionsとして弁のデータを送る -->
    <router-view :t1="{{ $ValveDataT1 }}" />
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
    <router-view :t2="{{ $ValveDataT2 }}" />
  </div>
</div>

@endsection