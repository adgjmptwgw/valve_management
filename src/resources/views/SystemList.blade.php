<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
  <!-- <script src="{{ secure_asset('js/app.js') }}" defer></script> -->

  <!-- 普通はVue.jsコンポーネントを使うページのbodyの最後付近で記述するが、
    deferを書いているので読み込みが最後になる。 -->
  <script src=" {{ mix('js/app.js') }} " defer></script>

  <!-- 付箋用 ・・・多分もういらない  -->
  <script src="{{ asset('/js/tag.js') }}" defer></script>

  <!-- Vueをblade.phpで使えるようにする。この書き方はダメ。仮使用のみOK。 -->
  <!-- <script src="https://unpkg.com/vue"></script> -->

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
  <link href="{{ secure_mix('css/app.css') }}" rel="stylesheet">

  <!-- Vue.jsを入れたときに追加した(2020/9/2)  もしかしたら、上の<link href="{{ asset('css/app.css') }}" rel="stylesheet">はいらないかも・・・ -->
  <!-- <link rel="stylesheet" href="{{ mix('css/app.css') }}" type="text/css"> -->
</head>
<!---------------------------------------------------------------------------------->

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
                <v-list-item-title>
                  <a href="{{ url('/DiagramsList') }}"> 1号機系統線図リスト </a>
                </v-list-item-title>
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

      <!-- 各系統線図へのリンクを記述 <router-link to=""> => router.js => 行先のコンポーネント -->
      <div class="main_text">
        <router-link to="/DiagramsList">
        </router-link>

        <!-- <div>
          <router-view />
        </div> -->
      </div>
    </div>

    <!-- DB => ValveOptionController => このblade.php => 各系統線図へ$ValveOptionsとして弁のデータを送る -->
    <router-view :u1_b4="{{ $ValveData_U1_B4 }}" :u1_b5="{{ $ValveData_U1_B5 }}" :u1_b9="{{ $ValveData_U1_B9 }}" :u1_b11="{{ $ValveData_U1_B11 }}" :u1_b17="{{ $ValveData_U1_B17 }}" :u1_b18="{{ $ValveData_U1_B18 }}" :u1_b19="{{ $ValveData_U1_B19 }}" :u1_b20="{{ $ValveData_U1_B20 }}" :u1_b21="{{ $ValveData_U1_B21 }}" :u1_b23="{{ $ValveData_U1_B23 }}" :u1_b24="{{ $ValveData_U1_B24 }}" :u1_b27="{{ $ValveData_U1_B27 }}" :u1_b30="{{ $ValveData_U1_B30 }}" :u1_b31="{{ $ValveData_U1_B31 }}" :u1_b34="{{ $ValveData_U1_B34 }}" :u1_b36="{{ $ValveData_U1_B36 }}" :u1_b37="{{ $ValveData_U1_B37 }}" :u1_b38="{{ $ValveData_U1_B38 }}" :u1_b41="{{ $ValveData_U1_B41 }}" :u1_t3="{{ $ValveData_U1_T3 }}" :u1_t4="{{ $ValveData_U1_T4 }}" :u1_t5="{{ $ValveData_U1_T5 }}" :u1_t6="{{ $ValveData_U1_T6 }}" :u1_t7="{{ $ValveData_U1_T7 }}" :u1_t8="{{ $ValveData_U1_T8 }}" :u1_t9="{{ $ValveData_U1_T9 }}" :u1_t10="{{ $ValveData_U1_T10 }}" :u1_t11="{{ $ValveData_U1_T11 }}" :u1_t12="{{ $ValveData_U1_T12 }}" :u1_t13="{{ $ValveData_U1_T13 }}" :u1_t16="{{ $ValveData_U1_T16 }}" :u1_t19="{{ $ValveData_U1_T19 }}" :u1_t20="{{ $ValveData_U1_T20 }}" :u1_t25="{{ $ValveData_U1_T25 }}" :u1_t26="{{ $ValveData_U1_T26 }}" :u1_t28="{{ $ValveData_U1_T28 }}" :u1_t30="{{ $ValveData_U1_T30 }}" :u1_t31="{{ $ValveData_U1_T31 }}" :u1_t32="{{ $ValveData_U1_T32 }}" :u1_t33="{{ $ValveData_U1_T33 }}" :u1_t36="{{ $ValveData_U1_T36 }}" :u1_e27="{{ $ValveData_U1_E27 }}" :u1_e29="{{ $ValveData_U1_E29 }}" :u1_e30="{{ $ValveData_U1_E30 }}" :u1_e31="{{ $ValveData_U1_E31 }}" :tags="{{ $TagsData }}" />
  </div>

</body>


<!---------------------------------------------------------------------------------->
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

  a {
    text-decoration: none;
  }
</style>