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
        storeU1_B4: [],
        storeU1_B5: [],
        storeU1_T3: [],
        storeU1_T4: [],
        // 付箋のデータ
        storeTags: []
    },
    mutations: {
        // ------------------< 弁・subオプション・付箋データ受取 & 更新 >------------------------
        // 目次(SystemListコンポーネント)更新時に以下イベント発火
        getDataValves(state, { arrayData, tagsData }) {
            // DBからの付箋データをstate.storeTagsへpush
            state.storeTags.push(tagsData);

            // Vue読み込み時、stateにDB(DB→T1.Vue経由)から引っ張ってきた配列データをpushで挿入する。
            let ary = [];
            for (let i = 0; i < arrayData.length; i++) {
                ary.push(arrayData[i].length);
            }
            // 配列のlengthの最大値を取得。※何回pushするか決定する。
            var max_val = Math.max.apply(null, ary);

            // 各系統線図のstateでの名称を配列へ代入。下記繰り返し処理で使用。
            let stateArray = [
                state.storeU1_B4,
                state.storeU1_B5,
                state.storeU1_T3,
                state.storeU1_T4
            ];
            // 目次ページを開いた時に各stateに各arrayData(DBからの各系統図の弁データ)を入力、更新
            for (let j = 0; j < stateArray.length; j++) {
                for (let i = 0; i < max_val; i++) {
                    stateArray[j].push(arrayData[j][i]);
                }
            }
        },

        // 開閉ボタンをクリックした際に対象の弁のidとvalve_state(弁の開閉状態)をstore.stateに挿入、値を更新する。
        changeValveStatus(
            state,
            {
                id,
                stateInput,
                nameInput,
                numberInput,
                usuallyStateInput,
                memoInput
            }
        ) {
            let stateArray = [
                state.storeU1_B4,
                state.storeU1_B5,
                state.storeU1_T3,
                state.storeU1_T4
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
                if (stateInput != undefined) {
                    stateArray[i][num].valve_state = stateInput;
                } else if (nameInput && numberInput != undefined) {
                    stateArray[i][num].valve_name = nameInput;
                    stateArray[i][num].valve_number = numberInput;
                    stateArray[i][num].valve_usually_state = usuallyStateInput;
                    stateArray[i][num].valve_memo = memoInput;
                } else {
                    alert("弁名称と弁番号を入力して下さい。");
                }
                // console.log(state.storeU1_T3);
                // stateArray[i][num].valve_state = stateInput;
                // stateArray[i][num].valve_name = nameInput;
                // stateArray[i][num].valve_number = numberInput;
                // stateArray[i][num].valve_usually_state = usuallyStateInput;
                // stateArray[i][num].valve_memo = memoInput;
            }
        },

        // ---------------------------< 付箋データ更新 >--------------------------------------

        // メモの保存ボタンを押した際にvuex.store.stateを更新する。
        changeTagStatus(state, { tagName, tagContent, tagPosi, tagShow }) {
            let getStore = state.storeTags[0].find(tagStore => {
                return tagStore.tag_name == tagName;
            });

            getStore.content = tagContent;
            getStore.position_X = tagPosi.x;
            getStore.position_Y = tagPosi.y;
            getStore.visibility = tagShow;
        }
    }
});
