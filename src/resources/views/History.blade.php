<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'バルブマネージメントシステム') }}</title>

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
    <div class="menu_bar">
      <v-app-bar app color="grey lighten-3" height="60px">
        <v-app-bar-nav-icon @click="menuShow = !menuShow"></v-app-bar-nav-icon>
        <!-- ロゴ -->
        <img src="/img/Parts/logo.png" alt="ロゴ" class="logo">
        <v-toolbar-title>
          バルブマネージメントシステム
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

    <p class="background_color_space">
      <!-- テーブルの上に背景色と同じ色のスペースを設置 -->
    </p>

    <p class="table_top">
      <!-- テーブルの上にテーブル枠と同じ色のスペースを設置 -->
    </p>

    
    <div class="whole_page">
      <table>
        <!-- テーブルヘッダ -->
        <thead class="table_columns">
          <th>
            <p class="table_column">弁名称</p>
          </th>
          <th>
            <p class="table_column">弁番号</p>
          </th>
          <th>
            <p class="table_column">通常開閉状態</p>
          </th>
          <th>
            <p class="table_column">現在の開閉状態</p>
          </th>
          <th>
            <p class="table_column">操作時刻</p>
          </th>
        </thead>
        <!-- テーブル本体 -->
        <tbody>
          @foreach ($histories as $history)
          <tr>
            <td>
              <div class="grey lighten-5 pa-4">
                <v-row>
                  <v-col>
                    <v-card>
                      <v-list width="1300px">
                        <v-list-item>
                          <v-list-item-action>
                            <v-icon>mdi-inbox-arrow-down</v-icon>
                          </v-list-item-action>
                          <v-list-item-content>
                            {{ $history->valve_name }}
                          </v-list-item-content>
                          <v-list-item-content>
                            {{ $history->valve_number }}
                          </v-list-item-content>
                          <v-list-item-content>
                            {{ $history->valve_usually_state }}
                          </v-list-item-content>
                          <v-list-item-content>
                            {{ $history->valve_state }}
                          </v-list-item-content>
                          <v-list-item-content>
                            {{ $history->created_at }}
                          </v-list-item-content>
                        </v-list-item>
                      </v-list>
                    </v-card>
                  </v-col>
                </v-row>
              </div>
            </td>
            <td>
              <!-- 削除ボタン -->
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    

    <!------------------------------------------------------------------------------->


  </div>
</body>

</html>

<style>
  .menu_bar {
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

  .whole_page {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 100px;
  }

  table {
    margin-top: 50px;
  }

  .table_column {
    font-size: 140%;
    margin: auto 65px auto 80px;
  }

  .table_columns {
    background-color: #FFABCE;
    position: fixed;
    width: 1310px;
    height: 60px;
    top: 100px;
    left: 60px;
    z-index: 1;
  }

  .table_top {
    background-color: #FFABCE;
    position: fixed;
    width: 1310px;
    height: 40px;
    top: 70px;
    left: 60px;
    z-index: 1;
  }

  .background_color_space {
    background-color: rgb(247, 253, 255);
    position: fixed;
    width: 1310px;
    height: 70px;
    top: 50px;
    left: 60px;
    z-index: 1;
  }

  a {
    text-decoration: none;
    transition: .2s;
  }

  a:link {
    color: black;
  }

  a:visited {
    color: black;
  }

  a:hover {
    color: red;
    font-size: 117%;
  }
</style>