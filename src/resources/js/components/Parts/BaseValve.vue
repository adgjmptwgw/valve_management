<template>
    <div>
        <div>
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

    </div>
</template>

<script>
export default {
    props: {
        optionId: {
            default: ""
        },
        optionUsuallyState: {
            default: ""
        },
        openCommand: {
            default: ""
        },
        closeCommand: {
            default: ""
        },
        adjustedCommand: {
            default: ""
        },
        systemDiagram: {
            default: ""
        }
    },
    data() {
        return {
            open: true,
            close: true,
            adjusted: true,
            isDisplayUnusual: false
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

                if (this.optionUsuallyState == "開") {
                    this.isDisplayUnusual = false;
                } else if (this.optionUsuallyState != "開") {
                    this.isDisplayUnusual = true;
                }
            }
        },
        closeCommand: function() {
            if (this.optionId == this.closeCommand) {
                this.open = false;
                this.close = true;
                this.adjusted = false;

                if (this.optionUsuallyState == "閉") {
                    this.isDisplayUnusual = false;
                } else if (this.optionUsuallyState != "閉") {
                    this.isDisplayUnusual = true;
                }
            }
        },
        adjustedCommand: function() {
            if (this.optionId == this.adjustedCommand) {
                this.open = false;
                this.close = false;
                this.adjusted = true;

                if (this.optionUsuallyState == "調整開") {
                    this.isDisplayUnusual = false;
                } else if (this.optionUsuallyState != "調整開") {
                    this.isDisplayUnusual = true;
                }
            }
        }
    },
    mounted() { 
        // もしt1の系統線図であれば、store.state.storeU1_T1のデータを使う。
        if ((this.systemDiagram == "u1_t1")) {
            var systemDiagrams = this.$store.state.storeU1_T1;            
        } else if ((this.systemDiagram == "u1_t2")) {
            var systemDiagrams = this.$store.state.storeU1_T2;
        } else if ((this.systemDiagram == "u1_b1")) {
            var systemDiagrams = this.$store.state.storeU1_B1;
        }

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

                if (this.optionUsuallyState == "開") {
                    this.isDisplayUnusual = false;
                } else if (this.optionUsuallyState != "開") {
                    this.isDisplayUnusual = true;
                }
            } else if (getStore.valve_state == "閉") {
                this.open = false;
                this.close = true;
                this.adjusted = false;

                if (this.optionUsuallyState == "閉") {
                    this.isDisplayUnusual = false;
                } else if (this.optionUsuallyState != "閉") {
                    this.isDisplayUnusual = true;
                }
            } else if (getStore.valve_state == "調整開") {
                this.open = false;
                this.close = false;
                this.adjusted = true;

                if (this.optionUsuallyState == "調整開") {
                    this.isDisplayUnusual = false;
                } else if (this.optionUsuallyState != "調整開") {
                    this.isDisplayUnusual = true;
                }
            }
        }
    }
};
</script>

<style scoped>
/* 通常「閉」のバルブimg */
.closeV {
    width: 25px;
    height: 15px;
    position: absolute;
}

/* 通常「開」のバルブimg */
.openV {
    width: 25px;
    height: 15px;
    position: absolute;
}

/* 「調整開」のバルブimg */
.adjustedV {
    width: 25px;
    height: 15px;
    position: absolute;
}
.unusual_valve {
    background-color: red;
}
</style>
