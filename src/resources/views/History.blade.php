<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'バルブ管理システム') }}</title>

  <!-- Scripts -->
  <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
  <!-- <script src="{{ secure_asset('js/app.js') }}" defer></script> -->

  <!-- 普通はVue.jsコンポーネントを使うページのbodyの最後付近で記述するが、
    deferを書いているので読み込みが最後になる。 -->
  <script src=" {{ mix('js/app.js') }} " defer></script>

  <!-- 付箋用 -->
  <script src="{{ asset('/js/tag.js') }}" defer></script>

  <!-- Vueをblade.phpで使えるようにする。この書き方はダメ。仮使用のみOK。 -->
  <!-- <script src="https://unpkg.com/vue"></script> -->

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <!-- <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet"> -->

  <!-- Vue.jsを入れたときに追加した(2020/9/2)  もしかしたら、上の<link href="{{ asset('css/app.css') }}" rel="stylesheet">はいらないかも・・・ -->
  <link rel="stylesheet" href="{{ mix('/css/app.css') }}" type="text/css">
</head>

<body>
  <div id="app">
    <div class="whole_page">
      <v-app-bar app color="grey lighten-3" height="60px">
        <v-app-bar-nav-icon @click="menuShow = !menuShow"></v-app-bar-nav-icon>
        <!-- ロゴ -->
        <img src="/img/Parts/logo.png" alt="ロゴ" class="logo">
        <v-toolbar-title>
          バルブ管理システム
        </v-toolbar-title>
      </v-app-bar>
      <div @click="menuShow = !menuShow">
        <v-navigation-drawer fixed v-if="menuShow">
          <v-list nav dense>
            <v-list-item-group>
              <v-list-item>
                <a href="{{ url('/home') }}"> ホーム </a>
              </v-list-item>
              <v-list-item>
                <a href="{{ url('/DiagramsList') }}">1号機系統線図リスト </a>
              </v-list-item>
              <v-list-item>
                <v-list-item-title>2号機系統線図リスト</v-list-item-title>
              </v-list-item>
              <v-list-item>
                <v-list-item-title>弁チェックリスト</v-list-item-title>
              </v-list-item>
              <v-list-item>
                <v-list-item-title>
                  <a href="{{ url('/History') }}"> 弁操作履歴管理 </a>
                </v-list-item-title>
              </v-list-item>
              <v-list-item>
                <v-list-item-title>ログアウト</v-list-item-title>
              </v-list-item>
            </v-list-item-group>
          </v-list>
        </v-navigation-drawer>
      </div>
    </div>

    <!------------------------------------------------------------------------------->

    @if (count($histories) > 0)
    <div class="test">
      <div>履歴リスト</div>
      <div>
        <table>
          <!-- テーブルヘッダ -->
          <thead>
            <th>履歴</th>
          </thead>
          <!-- テーブル本体 -->
          <tbody>
            @foreach ($histories as $history)
            <tr>
              <td>
                <div>{{ $history->id }}</div>
              </td>
              <td>
                <!-- 削除ボタン -->
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    @endif

  </div>
</body>

</html>

<style>
  .whole_page {
    display: flex;
    align-items: center;
  }

  .logo {
    height: 55px;
    width: auto;
    margin: 20px;
  }

  .main_text {
    font-size: 250%;
  }

  .test {
    margin-top: 100px;
  }
</style>