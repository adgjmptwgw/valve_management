<template>
    <v-app>
        <v-container class="test">
            <v-form class="valve_option" color="purple lighten-3" dark>
                <v-toolbar flat color="purple lighten-5" width="200px">
                    <img src="/img/Parts/gear.png" alt="歯車" />
                    <v-toolbar-title class="font-weight-light">
                        サブオプション
                    </v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn color="purple darken-4" fab small>
                        <v-icon @click="invisibleOthersOption()"
                            >mdi-close</v-icon
                        >
                    </v-btn>
                </v-toolbar>
                <v-form>
                    <v-col class="d-flex" cols="5" sm="2">
                        <v-text-field
                            v-model="nameInput"
                            filled
                            :counter="30"
                            :rules="nameRules"
                            label="弁名称"
                            required
                        ></v-text-field>
                    </v-col>
                    <v-col class="d-flex" cols="5" sm="2">
                        <v-text-field
                            v-model="numberInput"
                            filled
                            :counter="15"
                            :rules="numberRules"
                            label="弁番号"
                            required
                        ></v-text-field>
                    </v-col>
                    <v-col class="d-flex" cols="5" sm="2">
                        <v-select
                            :items="usualStatus"
                            filled
                            label="通常状態"
                            dense
                            v-model="usuallyStateInput"
                        ></v-select>
                    </v-col>
                    <v-col class="d-flex" cols="5" sm="2">
                        <v-textarea
                            v-model="memoInput"
                            filled
                            :counter="100"
                            :rules="memoRules"
                            label="メモ"
                            required
                        ></v-textarea>
                    </v-col>
                    <v-col>
                        <v-btn
                            @click="
                                sendDataAxios(),
                                    sendDataStore(),
                                    invisibleOthersOption(),
                                    usuallyStateUpdate();
                                usuallyStateReset();
                            "
                        >
                            保存
                        </v-btn>
                    </v-col>
                </v-form>
            </v-form>
        </v-container>
    </v-app>
</template>

<script>
export default {
    props: [
        "optionId",
        // "optionName",
        // "optionNumber",
        // "optionUsuallyState",
        // "optionMemo",
        "systemDiagram"
    ],
    data() {
        return {
            // 入力フォームに初期表示させる為に、直接データを代入。
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
        // もしt1の系統線図であれば、store.state.storeU1_T1のデータを使う。
        if (this.systemDiagram == "u1_t3") {
            var systemDiagrams = this.$store.state.storeU1_T3;
        } else if (this.systemDiagram == "u1_t4") {
            var systemDiagrams = this.$store.state.storeU1_T4;
        } else if (this.systemDiagram == "u1_b4") {
            var systemDiagrams = this.$store.state.storeU1_B4;
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
.test{
    margin: auto 0;
}
</style>
