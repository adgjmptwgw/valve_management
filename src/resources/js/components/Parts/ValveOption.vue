<template>
    <v-app>
        <v-container>
            <v-card
                width="230px"
                height="750px"
                elevation="24"
                link
            >
                <v-toolbar color="pink lighten-4" class="valve_names">
                    <img src="/img/Parts/gear.png" alt="歯車" />
                    <v-toolbar-title>バルブオプション</v-toolbar-title> 
                </v-toolbar>
                <v-col>
                    <v-col>
                        <p class="valve_names">{{ optionName }}</p>
                    </v-col>
                    <v-col>
                        <p class="valve_names">{{ optionNumber }}</p>
                    </v-col>
                </v-col>
                <v-divider></v-divider>
                <v-col>
                    <v-btn
                        class="btns_style"
                        name="valve_state"
                        :value="valueOpen"
                        @click="
                            (open = false),
                                (close = true),
                                (adjusted = false),
                                (stateInput = valueOpen),
                                updateOption(),
                                commandOpen(),
                                resetOpen(),
                                sendStore(),
                                storeHistory()
                        "
                        width="205px"
                        height="50px"
                        color="grey lighten-4"
                        >開
                    </v-btn>
                </v-col>
                <v-col>
                    <v-btn
                        class="btns_style"
                        name="valve_state"
                        :value="valueClose"
                        @click="
                            (close = false),
                                (open = true),
                                (adjusted = false),
                                (stateInput = valueClose),
                                updateOption(),
                                commandClose(),
                                resetClose(),
                                sendStore(),
                                storeHistory()
                        "
                        width="205px"
                        height="50px"
                        color="grey lighten-4"
                        >閉
                    </v-btn>
                </v-col>
                <v-col>
                    <v-btn
                        class="btns_style"
                        name="valve_state"
                        :value="valueAdjusted"
                        @click="
                            (close = false),
                                (open = false),
                                (adjusted = true),
                                (stateInput = valueAdjusted),
                                updateOption(),
                                commandAdjusted(),
                                resetAdjusted(),
                                sendStore(),
                                storeHistory()
                        "
                        width="205px"
                        height="50px"
                        color="grey lighten-4"
                        >調整開
                    </v-btn>
                </v-col>
                <v-col>
                    <v-btn
                        class="btns_style"
                        @click="othersOption()"
                        width="205px"
                        height="50px"
                        color="grey lighten-4"
                    >
                        その他オプション
                    </v-btn>
                </v-col>
            </v-card>
        </v-container>
    </v-app>
</template>

<script>
export default {
    props: ["optionId", "optionNumber", "optionName", "optionUsuallyState"],
    data() {
        return {
            // :valueに入っている値。
            valueOpen: "開",
            valueClose: "閉",
            valueAdjusted: "調整開",

            // クリックした弁の:value値(開・閉・調整開)が入る。上記のvalueopen/close/adjustedが入る。
            // axiosでデータベースに送ったり、Vuexのstoreにデータを渡す役割がある。
            stateInput: "",
            now: new Date()
        };
    },
    methods: {
        updateOption() {
            // タイマーで遅らせる理由
            // propsに弁1番が入っている時に弁2番を操作する→弁2番の操作が弁1番の方に反映されてしまう。
            setTimeout(
                () =>
                    // axiosでデータを送る(このコンポーネント=>app/Http/Request/StoreOption.php=>ValveController=>DB)
                    axios
                        .put("/api/System/" + this.optionId, {
                            valve_state: this.stateInput
                        })
                        .then(response => {
                            console.log(response);
                        }),
                200
            );
        },
        storeHistory() {
            // タイマーで遅らせる理由
            // propsに弁1番が入っている時に弁2番を操作する→弁2番の操作が弁1番の方に反映されてしまう。
            setTimeout(
                () =>
                    // axiosでデータを送る(このコンポーネント=>app/Http/Request/StoreOption.php=>ValveController=>DB)
                    axios
                        .post("/api/System", {
                            valve_name:this.optionName,
                            valve_number:this.optionNumber,
                            valve_usually_state:this.optionUsuallyState,
                            valve_state: this.stateInput,
                            operator:"",
                        })
                        .then(response => {
                            console.log(response);
                        }),
                200
            );
        },
        // 開閉ボタンを押した際、開閉表示が変わる処理に使う。
        commandOpen() {
            this.$emit("push-open");
        },
        commandClose() {
            this.$emit("push-close");
        },
        commandAdjusted() {
            this.$emit("push-adjusted");
        },
        //系統線図(B1・T1.Vue等々)のイベントを発火する。
        // これをしないと、1度「開」ボタンを押した後、2度目に押しても弁の開閉表示が変わらない。
        // 系統線図(B1・T1.Vue等々)及び、UsuallyOpen/Close/Adjusted.Vueのwatch参照。
        resetOpen() {
            this.$emit("push-reset-open");
        },
        resetClose() {
            this.$emit("push-reset-close");
        },
        resetAdjusted() {
            this.$emit("push-reset-adjusted");
        },
        // 弁オプションで開閉ボタンを押した際に、Vuexのstoreに状態を更新する処理
        sendStore() {
            this.$emit("push-state-button", this.stateInput);
        },
        // sendStoreHistory() {
        //     this.$store.commit("changeValveStatus", {
        //         numberInput: this.optionNumber,
        //         nameInput: this.optionName,
        //         time: this.now
        //     });
        // },
        othersOption() {
            this.$emit("push-others-button");
        },
        // time: function(e) {
        //     var date = new Date();

        //     this.now =
        //         date.getFullYear() +
        //         "年 " +
        //         date.getMonth() +
        //         "月 " +
        //         date.getDate() +
        //         "日  " +
        //         date.getHours() +
        //         ":" +
        //         date.getMinutes() +
        //         ":" +
        //         date.getSeconds();
        // }
    }
};
</script>

<style scoped>
.valve_names {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    font-size: 120%;
}
.btns_style {
    margin: 20px auto;
    font-size: 130%;
}
</style>
