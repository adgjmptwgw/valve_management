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
    <div class="whole_page">
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
                <a href="{{ url('/home') }}" class="menu_content"> ホーム </a>
              </v-list-item>
              <v-list-item>
                <a href="{{ url('/DiagramsList') }}" class="menu_content"> 1号機系統線図リスト </a>
              </v-list-item>
              <v-list-item>
                <v-list-item-title class="menu_content">2号機系統線図リスト</v-list-item-title>
              </v-list-item>
              <v-list-item>
                <v-list-item-title class="menu_content">弁チェックリスト</v-list-item-title>
              </v-list-item>
              <v-list-item>
                <v-list-item-title>
                  <a href="{{ url('/History') }}" class="menu_content"> 弁操作履歴管理 </a>
                </v-list-item-title>
              </v-list-item>
              <v-list-item>
                <v-list-item-title class="menu_content">ログアウト</v-list-item-title>
              </v-list-item>
            </v-list-item-group>
          </v-list>
        </v-navigation-drawer>
      </div>

      <div class="main_content">
        <div class="main_top">
          <div class="app_title">
            <img src="/img/Parts/logo.png" alt="ロゴ" class="logo2">
            <h1>バルブマネージメントシステム</h1>
          </div>
          <img src="/img/Parts/home_img.jpg" alt="ホーム画像" class="home_img">
        </div>

        <div class="main_bottom">
          <a href="{{ url('/DiagramsList') }}">
            <v-card class="main_bottom_content">
              <div class="bottom_content">
                <h2>1号機系統線図</h2>
                <img src="/img/Parts/manage_diagram_1u.jpg" alt="系統線図管理img" class="main_bottoms_img">
              </div>
            </v-card>
          </a>
          <a href="">
            <v-card class="main_bottom_content">
              <div class="bottom_content">
                <h2>2号機系統線図</h2>
                <img src="/img/Parts/manage_diagram_2u.jpg" alt="系統線図管理img" class="main_bottoms_img">
              </div>
            </v-card>
          </a>
          <a href="">
            <v-card class="main_bottom_content" elevation="24">
              <div class="bottom_content">
                <h2>弁チェック</h2>
                <img src="/img/Parts/manage_valve.png" alt="弁チェックimg" class="main_bottoms_img">
              </div>
            </v-card>
          </a>
          <a href="{{ url('/History') }}">
            <v-card class="main_bottom_content">
              <div class="bottom_content">
                <h2>操作履歴</h2>
                <img src="/img/Parts/history.png" alt="PC履歴img" class="main_bottoms_img">
              </div>
            </v-card>
          </a>
        </div>
      </div>
    </div>
  </div>
</body>

</html>

<style>
  .whole_page {
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .logo {
    height: 55px;
    width: auto;
    margin: 20px;
  }

  /* main部分の全て */
  .main_content {
    margin-top: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
  }

  /* mein大きい方の背景のロゴ */
  .logo2 {
    height: 200px;
    width: auto;
    margin: 20px;
    position: absolute;
    top: 80px;
    left: 230px;
  }

  /* main背景上にあるアプリケーションタイトル */
  .main_text {
    font-size: 250%;
  }

  .main_top {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 1425px;
  }

  .main_bottom {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 10px auto;
  }

  /* タイトル */
  div h1 {
    color: white;
    font-size: 450%;
    font-weight: bold;
    position: absolute;
    top: 290px;
    left: 310px;
  }

  /* mainの背景 */
  .home_img {
    width: 1425px;
    height: 500px;
  }

  /* main下の各メニュー全て */
  .main_bottom_content {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: auto 20px;
    width: 290px;
    height: 240px;
  }

  /* main下の各メニュー1つ1つに付与したclass */
  .bottom_content {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
  }

  .main_bottoms_img {
    width: 150px;
    height: 170px;
  }

  a {
    text-decoration: none;
    transition: 0.2s;
  }

  a:link {
    color: black;
  }

  a:visited {
    color: black;
  }

  .menu_content:hover {
    color: red;
    font-size: 117%;
  }

  .main_bottom_content:hover {
    width: 320px;
    height: 270px;
    opacity: 0.9;
  }
</style>