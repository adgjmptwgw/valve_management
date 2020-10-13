<template>
    <div>
        <!-- 各「開」「閉」「調整開」の画像 -->
        <img
            :src="'/img/Parts/open_valve_2.png'"
            alt="弁「開」"
            class="openV"
            :class="{ unusual_valve: isDisplayUnusual }"
            v-if="open"
        />
        <img
            :src="'/img/Parts/close_valve_2.png'"
            alt="弁「閉」"
            class="closeV"
            :class="{ unusual_valve: isDisplayUnusual }"
            v-if="close"
        />
        <img
            :src="'/img/Parts/adjusted_valve_2.png'"
            alt="「調整開」"
            class="adjustedV"
            :class="{ unusual_valve: isDisplayUnusual }"
            v-if="adjusted"
        />
    </div>
</template>

<script>
export default {
    props: [
        // 最新のクリックした弁のid
        "optionId",
        // ↓いらないかも・・・
        "optionUsuallyState",
        // watchで用いる。開閉ボタンを押した際に弁の開閉表示を切り替える際に使用。
        "openCommand",
        "closeCommand",
        "adjustedCommand",
        // "u1_t1"等のデータが入っている。
        "systemDiagram",
        // 弁のidが入っている。watchの弁の通常状態表示に関する処理で用いる。
        "watchStatus"
    ],
    data() {
        return {
            open: true,
            close: true,
            adjusted: true,
            isDisplayUnusual: false,
            // storeからのバルブデータ
            getStoreValve: []
        };
    },
    watch: {
        openCommand: function() {
            // 開ボタンを押した時に弁の表示を変化させる処理。データの流れ:valveption => (例)U1_T1.vue => BaseValve。
            // その弁のidとクリックした弁のidが同じであれば、弁の開閉表示を切り替える。
            // この処理をしないと、開ボタンクリック時に閉状態の弁全てが開表示に切り替わってしまう。
            if (this.optionId == this.openCommand) {
                this.open = true;
                this.close = false;
                this.adjusted = false;

                if (this.getStoreValve.valve_usually_state == "開") {
                    this.isDisplayUnusual = false;
                } else if (this.getStoreValve.valve_usually_state != "開") {
                    this.isDisplayUnusual = true;
                }
            }
        },
        closeCommand: function() {
            if (this.optionId == this.closeCommand) {
                this.open = false;
                this.close = true;
                this.adjusted = false;

                if (this.getStoreValve.valve_usually_state == "閉") {
                    this.isDisplayUnusual = false;
                } else if (this.getStoreValve.valve_usually_state != "閉") {
                    this.isDisplayUnusual = true;
                }
            }
        },
        adjustedCommand: function() {
            if (this.optionId == this.adjustedCommand) {
                this.open = false;
                this.close = false;
                this.adjusted = true;

                if (this.getStoreValve.valve_usually_state == "調整開") {
                    this.isDisplayUnusual = false;
                } else if (this.getStoreValve.valve_usually_state != "調整開") {
                    this.isDisplayUnusual = true;
                }
            }
        },
        watchStatus: function() {
            if (
                this.getStoreValve.valve_usually_state !=
                this.getStoreValve.valve_state
            ) {
                this.isDisplayUnusual = true;
            } else if (
                this.getStoreValve.valve_usually_state ==
                this.getStoreValve.valve_state
            ) {
                this.isDisplayUnusual = false;
            }
        }
    },
    mounted() {
        // もしt1の系統線図であれば、store.state.storeU1_T1のデータを使う。
        const storeArray = ["u1_b4","u1_b5", "u1_t3", "u1_t4"];
        const systemDiagramArray = [
            this.$store.state.storeU1_B4,
            this.$store.state.storeU1_B5,
            this.$store.state.storeU1_T3,
            this.$store.state.storeU1_T4
        ];

        for (let i = 0; i < storeArray.length; i++) {
            if (this.systemDiagram == storeArray[i]) {
                var systemDiagrams = systemDiagramArray[i];
            }
        }

        // if (this.systemDiagram == "u1_t3") {
        //     var systemDiagrams = this.$store.state.storeU1_T3;
        // } else if (this.systemDiagram == "u1_t4") {
        //     var systemDiagrams = this.$store.state.storeU1_T4;
        // } else if (this.systemDiagram == "u1_b4") {
        //     var systemDiagrams = this.$store.state.storeU1_B4;
        // }

        // Vuexのstore.stateの中から、state.idとクリックした弁のidが同じものを探し出して、変数にいれる。
        let getStore = systemDiagrams.find(valvesStore => {
            return valvesStore.id == this.optionId;
        });

        // propsで系統線図(B1.T1/vue等々)から送られてきたoptionId(弁のid)とstoreのidが同じものだけ、
        // 系統線図ページを開く時に弁の開閉表示を切り替える。
        // この処理をしない場合→開ボタンクリック後に,ページを開き直すと閉状態の弁全てが開表示に
        // 切り替わってしまう。
        if (this.optionId == getStore.id) {
            if (getStore.valve_state == "開") {
                this.open = true;
                this.close = false;
                this.adjusted = false;

                if (getStore.valve_usually_state == "開") {
                    this.isDisplayUnusual = false;
                } else if (getStore.valve_usually_state != "開") {
                    this.isDisplayUnusual = true;
                }
            } else if (getStore.valve_state == "閉") {
                this.open = false;
                this.close = true;
                this.adjusted = false;

                if (getStore.valve_usually_state == "閉") {
                    this.isDisplayUnusual = false;
                } else if (getStore.valve_usually_state != "閉") {
                    this.isDisplayUnusual = true;
                }
            } else if (getStore.valve_state == "調整開") {
                this.open = false;
                this.close = false;
                this.adjusted = true;

                if (getStore.valve_usually_state == "調整開") {
                    this.isDisplayUnusual = false;
                } else if (getStore.valve_usually_state != "調整開") {
                    this.isDisplayUnusual = true;
                }
            }

            // storeからのバルブデータをwatchで用いる為、getStoreValveに代入。
            this.getStoreValve = getStore;
        }
    }
};
</script>

<style scoped>
/* 通常「閉」のバルブimg */
.closeV {
    width: 100%;
    height: 100%;
    position: absolute;
    object-fit: contain;
}

/* 通常「開」のバルブimg */
.openV {
    width: 100%;
    height: 100%;
    position: absolute;
    object-fit: contain;
}

/* 「調整開」のバルブimg */
.adjustedV {
    width: 100%;
    height: 100%;
    position: absolute;
    object-fit: contain;
}
.unusual_valve {
    background-color: red;
}
</style>
