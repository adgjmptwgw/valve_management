<template>
    <v-app>
        <v-container class="sub_option"> 
            <v-toolbar flat color="grey lighten-2" width="1200px">
                <img src="/img/Parts/gear.png" alt="歯車" />
                <v-toolbar-title class="font-weight-light">
                   <p class="title_name">サブオプション</p>
                </v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn color="grey lighten-4" fab>
                    <v-icon @click="invisibleOthersOption()">mdi-close</v-icon>
                </v-btn>
            </v-toolbar>
            <v-card height="600px">
                <v-col class="d-flex" width="1000px">
                    <v-text-field
                        v-model="nameInput"
                        filled
                        :counter="30"
                        :rules="nameRules"
                        label="弁名称"
                        required
                    ></v-text-field>
                </v-col>
                <v-col class="d-flex" width="1000px">
                    <v-text-field
                        v-model="numberInput"
                        filled
                        :counter="15"
                        :rules="numberRules"
                        label="弁番号"
                        required
                    ></v-text-field>
                </v-col>
                <v-col class="d-flex" width="1000px">
                    <v-select
                        :items="usualStatus"
                        filled
                        label="通常状態"
                        dense
                        v-model="usuallyStateInput"
                    ></v-select>
                </v-col>
                <v-col class="d-flex" width="1000px">
                    <v-textarea
                        v-model="memoInput"
                        filled
                        :counter="100"
                        :rules="memoRules"
                        label="メモ"
                        required
                    ></v-textarea>
                </v-col>
                <v-col class="save_btn">
                    <v-btn
                        @click="
                            sendDataAxios(),
                                sendDataStore(),
                                invisibleOthersOption(),
                                usuallyStateUpdate();
                            usuallyStateReset();
                        "
                        width="300px"
                        height="50px"
                    >
                        保存
                    </v-btn>
                </v-col>
            </v-card>
        </v-container>
        <div id="overlay"></div>
    </v-app>
</template>

<script>
export default {
    props: [
        "optionId",
        "systemDiagram"
    ],
    data() {
        return {
            // 入力フォームに初期表示させる為に、storeからデータを代入。
            nameInput: "",
            numberInput: "",
            usuallyStateInput: "",
            memoInput: "",

            // 通常状態セレクトボックスの選択肢
            usualStatus: ["開", "閉", "調整開"],

            // 各フォームの文字数validation処理。注意喚起の文章が表示されるだけ。
            nameRules: [
                v => !!v || "弁名称を入力して下さい",
                v => (v && v.length <= 30) || "30文字以下で入力して下さい"
            ],
            numberRules: [
                v => !!v || "弁番号を入力して下さい",
                v => (v && v.length <= 15) || "15文字以下で入力して下さい"
            ],
            memoRules: [v => v.length <= 100 || "100文字以下で入力して下さい"],

            getStoreValve: ""
        };
    },
    mounted() {
        const storeArray = ["u1_b4", "u1_b5", "u1_t3", "u1_t4"];
        const systemDiagramArray = this.$store.state.storeValves;
        for (let i = 0; i < storeArray.length; i++) {
            if (this.systemDiagram == storeArray[i]) {
                var systemDiagrams = systemDiagramArray[i];
                // console.log(systemDiagrams);
            }
        }
    
        // Vuexのstore.stateの中から、state.idとクリックした弁のidが同じものを探し出して、変数にいれる。
        let getStore = systemDiagrams.find(valvesStore => {
            return valvesStore.id == this.optionId;
        });

        this.getStoreValve = getStore;

        // propsで系統線図(B1.T1/vue等々)から送られてきたoptionId(弁のid)とstoreのidが同じものだけ、
        // 系統線図ページを開く時に弁の開閉表示を切り替える。
        // この処理をしない場合→開ボタンクリック後に,ページを開き直すと閉状態の弁全てが開表示に
        // 切り替わってしまう。
        this.nameInput = getStore.valve_name;
        this.numberInput = getStore.valve_number;
        this.usuallyStateInput = getStore.valve_usually_state;
        this.memoInput = getStore.valve_memo;
    },
    methods: {
        // 保存ボタンを押すと、DBへデータを飛ばす
        sendDataAxios() {
            axios
                .put("/api/System/" + this.optionId, {
                    valve_name: this.nameInput,
                    valve_number: this.numberInput,
                    valve_usually_state: this.usuallyStateInput,
                    valve_memo: this.memoInput
                })
                .then(response => {
                    console.log(response);
                });
        },
        // 保存ボタンを押すとVuexのstoreへデータが送信される。
        sendDataStore() {
            this.$store.commit("changeValveStatus", {
                id: this.optionId,
                nameInput: this.nameInput,
                numberInput: this.numberInput,
                usuallyStateInput: this.usuallyStateInput,
                memoInput: this.memoInput
            });
        },
        // 保存ボタンを押した際にその他オプションが消えるようにする。
        invisibleOthersOption: function() {
            this.$emit("push-save-invisible");
        },
        usuallyStateUpdate() {
            this.$emit("push-save-update");
        },
        usuallyStateReset() {
            this.$emit("push-save-reset");
        }
    }
};
</script>

<style scoped>
.title_name{
    font-size: 115%;
    width: 1000px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.sub_option {
    width: 1200px;
    position: absolute;
    /* ローカル環境では-450pxが適切 */
    top: -450px;
    /* top: 100px; */
    left: 200px;
    z-index: 2;
}
/* モーダルウィンドウ */
#overlay{
  /* 要素を重ねた時の順番 */
  z-index:1;

  /* 画面全体を覆う設定 */
  position:fixed;
  top:0;
  left:0;
  width:100%;
  height:100%;
  background-color:rgba(0,0,0,0.5);

  /* 画面の中央に要素を表示させる設定 */
  display: flex;
  align-items: center;
  justify-content: center;
}
/* 保存ボタンを囲む<v-col>のスタイル */
.save_btn{
    width: 1200px;
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
