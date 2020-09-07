/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

// Vueのrouterを使う際には以下2行を追加？
import Vue from "vue";
import VueRouter from "vue-router";

import router from "./router";

window.Vue = require('vue');
// Vueのrouterを使う際には以下追加
Vue.use(VueRouter);

// Vueのrouterを使う際に「router」追加
const app = new Vue({
    el: "#app",
    router
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// 下記の2行のおかげでコンポーネントの登録を行う必要はない。自動で登録される。
const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// 下記はコンポーネントの登録
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: "#app"
// });
