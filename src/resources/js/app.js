/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

// Vueのrouterで使用
import Vue from "vue";
import VueRouter from "vue-router";
import router from "./router";
Vue.use(VueRouter);

// Vuexで使用
import store from "./store";

// Vuetifyで使用
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";
Vue.use(Vuetify);

// デフォルトで書いてるやつ
window.Vue = require("vue");


// Vueのrouterを使う際に「router」追加(一番下の行に記述している。一番下でないと、コンポーネントが読み込めない)
// const app = new Vue({
//     router
// });

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// 下記の2行のおかげでコンポーネントの登録を行う必要はない。自動で登録される。
const files = require.context("./", true, /\.vue$/i);
files.keys().map(key =>
    Vue.component(
        key
            .split("/")
            .pop()
            .split(".")[0],
        files(key).default
    )
);

// 下記はコンポーネントの登録
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('T1', require('./components/SystemDiagram/T1.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: "#app"
// });
// Vueのrouterを使う際に「router」追加
const app = new Vue({
    el: "#app",
    vuetify: new Vuetify(),
    data: {
        show: true
    },
    methods: {
        // hoge() {
        // }
    },
    // mounted() {
    //     this.show = true;
    //     alert("test");
    // },

    // Vue-router使用
    router,
    // Vuex使用
    store
    // Vuetufyで使用
});
