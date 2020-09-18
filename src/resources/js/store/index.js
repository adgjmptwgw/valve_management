import Vue from "vue";
import Vuex from "vuex";

// 以下が自分のファイル
// import valveState from "./valveState";
// import alert from "./modules/alert";

Vue.use(Vuex);

export default new Vuex.Store({
    // 以下2行は自分が使うやつ
    // modules: {
    //     valveState,
    // }

    state: {
        count: 2
    }
});
