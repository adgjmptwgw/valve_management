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
        storeU1_T1: [],
        storeU1_T2: [],
        storeU1_B1: []
    },
    mutations: {
        getData(state, { arrayData }) {
            let ary = [];
            for (let i = 0; i < arrayData.length; i++) {
                ary.push(arrayData[i].length);
            }
            // 配列のlengthの最大値を取得。
            var max_val = Math.max.apply(null, ary);

            // 各系統線図のstateでの名称を配列へ代入。下記繰り返し処理で使用。
            let stateArray = [
                state.storeU1_T1,
                state.storeU1_T2,
                state.storeU1_B1
            ];
            // 目次ページを開いた時に各stateに各arrayData(DBからの各系統図の弁データ)を入力、更新
            for (let j = 0; j < stateArray.length; j++) {
                for (let i = 0; i < max_val; i++) {
                    stateArray[j].push(arrayData[j][i]);
                }
            }
        },

        // ----------------------------------------------------------------------
        // Vue読み込み時、stateにDB(DB→T1.Vue経由)から引っ張ってきた配列データをpushで挿入する。
        // getData(state, { arrayData, systemDiagrams }) {
        //     if (systemDiagrams == "u1_t1") {
        //         var stateVariable = state.storeU1_T1;
        //     } else if (systemDiagrams == "u1_t2") {
        //         var stateVariable = state.storeU1_T2;
        //     } else if (systemDiagrams == "u1_b1") {
        //         var stateVariable = state.storeU1_B1;
        //     }

        //     for (let i = 0; i < arrayData.length; i++) {
        //         stateVariable.push(arrayData[i]);
        //     }
        // },

        // 開閉ボタンをクリックした際に対象の弁のidとvalve_state(弁の開閉状態)をstore.stateに挿入、値を更新する。
        changeStatus(state, { id, stateInput }) {
            let stateArray = [
                state.storeU1_T1,
                state.storeU1_T2,
                state.storeU1_B1
            ];
            // "引数のid"と"stateのid"が同じものを探してくる。
            for (let i = 0; i < stateArray.length; i++) {
                let getStore = stateArray[i].find(valvesStore => {
                    return valvesStore.id == id;
                });
                // 上記のidの配列の順番を取得する
                var num = stateArray[i].findIndex(
                    ({ id }) => id == getStore.id
                );
        // i番目のstate配列のnum番目のvalve_state(弁開閉状態)をstateInput(開・閉・調整開)の状態にする。
                stateArray[i][num].valve_state = stateInput;
            }

            // let getStore1 = stateArray[0].find(valvesStore => {
            //     return valvesStore.id == id;
            // });
            // let getStore2 = stateArray[1].find(valvesStore => {
            //     return valvesStore.id == id;
            // });
            // let getStore3 = stateArray[2].find(valvesStore => {
            //     return valvesStore.id == id;
            // });

            // var num1 = stateArray[0].findIndex(({ id }) => id == getStore1.id);
            // var num2 = stateArray[1].findIndex(({ id }) => id == getStore2.id);
            // var num3 = stateArray[2].findIndex(({ id }) => id == getStore3.id);
            // // console.log(num1);

            // stateArray[0][num1].valve_state = stateInput;
            // stateArray[1][num2].valve_state = stateInput;
            // stateArray[2][num3].valve_state = stateInput;

            // const obj = [
            //     { num: 0, name: "AAA", age: "60" },
            //     { num: 1, name: "BBB", age: "20" },
            //     { num: 2, name: "CCC", age: "40" },
            //     { num: 3, name: "DDD", age: "50" }
            // ];
            // obj.findIndex(({ name }) => name === "DDD");
            // obj.findIndex(({ age }) => age === "20");
        }
        // ----------------------------------------------------------------------
        // changeStatus(state, { id, systemDiagram, stateInput }) {
        //     if (systemDiagram == "u1_t1") {
        //         var systemDiagrams = state.storeU1_T1;
        //     } else if (systemDiagram == "u1_t2") {
        //         var systemDiagrams = state.storeU1_T2;
        //     } else if (systemDiagram == "u1_b1") {
        //         var systemDiagrams = state.storeU1_B1;
        //     }

        //     let getStore = systemDiagrams.find(valvesStore => {
        //         return valvesStore.id == id;
        //     });

        //     var num = systemDiagrams.indexOf(getStore);
        //     console.log(num);

        //     state.systemDiagrams[num].valve_state = stateInput;

        // ----------------------------------------------------------------------
        //     changeStatus(state, { index,stateInput }) {
        //     state.storeU1_T1[index].valve_state = stateInput;
        //     state.storeU1_T2[index].valve_state = stateInput;
        //     state.storeU1_B1[index].valve_state = stateInput;
        // }
    }
});
