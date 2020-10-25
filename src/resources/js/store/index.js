import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        // 弁のデータ。この中に更に配列が入っている。※配列名u1_b4等。
        storeValves: [],
      
        // 付箋のデータ
        storeTags: [],

        // 履歴の各項目(弁の名前、番号、操作時間)
        // historyNumber: [],
        // historyName: [],
        // historyTime: []
    },
    mutations: {
        // ------------------< 弁・subオプション・付箋データ受取(push)  >------------------------
        // 目次(SystemListコンポーネント)更新時に以下イベント発火
        getDataValves(state, { arrayData, tagsData }) {
            // DBからの付箋データをstate.storeTagsへpush
            state.storeTags.push(tagsData);
            // pushでページをcreatedする度に配列の中身が増えていく為、増えた分のデータを削除
            state.storeTags.splice(tagsData.length, tagsData.length);

            // state.storeValves = [];
            for (let i = 0; i < arrayData.length; i++) {
                state.storeValves.push(arrayData[i]);
            }
            // pushでページをcreatedする度に配列の中身が増えていく為、増えた分のデータを削除
            state.storeValves.splice(arrayData.length, arrayData.length);
        },
        // ------------------< 弁オプション/サブオプション更新処理 >------------------------
        // 開閉ボタンをクリックした際に対象の弁のidとvalve_state(弁の開閉状態)をstore.stateに挿入、値を更新する。
        changeValveStatus(
            state,
            {
                id,
                stateInput,
                nameInput,
                numberInput,
                usuallyStateInput,
                memoInput,
                // time
            }
        ) {
            // if (time != undefined) {
            //     state.historyNumber.push(numberInput);
            //     state.historyName.push(nameInput);
            //     state.historyTime.push(time);
            // }

            // console.log(state.historyNumber);
            // console.log(state.historyName);
            // console.log(state.historyTime);

            for (let i = 0; i < state.storeValves.length; i++) {
                // "引数のid"と"stateのid"が同じものを探してくる。
                var getStore = state.storeValves[i].find(valvesStore => {
                    return valvesStore.id == id;
                });

                if (getStore != undefined) {
                    var num = state.storeValves[i].findIndex(
                        ({ id }) => id == getStore.id
                    );

                    // i番目のstate配列のnum番目のvalve_state(弁開閉状態)をstateInput(開・閉・調整開)の状態にする。
                    if (stateInput != undefined) {
                        // 弁オプション更新処理
                        state.storeValves[i][num].valve_state = stateInput;
                    } else if (nameInput && numberInput != undefined) {
                        // 弁サブオプション更新処理
                        state.storeValves[i][num].valve_name = nameInput;
                        state.storeValves[i][num].valve_number = numberInput;
                        state.storeValves[i][
                            num
                        ].valve_usually_state = usuallyStateInput;
                        state.storeValves[i][num].valve_memo = memoInput;
                    } else {
                        alert("弁名称と弁番号を入力して下さい。");
                    }
                } else {
                    // console.log(
                    //     "id=" +
                    //         id +
                    //         "の弁はstoreValvesの" +
                    //         [i] +
                    //         "番目の配列の中に存在しません。"
                    // );
                }
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
