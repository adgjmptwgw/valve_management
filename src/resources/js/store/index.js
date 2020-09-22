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
        storeT1: [],
        storeT2: [],
    },
    mutations: {
        // Vue読み込み時、stateにDB(DB→T1.Vue経由)から引っ張ってきた配列データをpushで挿入する。
        getData(state, { arrayData, systemDiagrams }) {
            if (systemDiagrams == "t1") {
                var stateVariable = state.storeT1;
            } else if (systemDiagrams == "t2") {
                var stateVariable = state.storeT2;
            }
            // console.log(stateVariable);

            for (let i = 0; i < arrayData.length; i++) {
                stateVariable.push(arrayData[i]);
            }
            // console.log(state.storeT1[0].valve_state);
        },
        // 開閉ボタンをクリックした際に対象の弁のidとvalve_stateをstateに挿入、値を更新する。
        changeStatus(state, { index, stateInput }) {
            state.storeT1[index].valve_state = stateInput;
        }
    }
});
