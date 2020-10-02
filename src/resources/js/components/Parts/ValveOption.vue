<template>
    <div>
        <fieldset class="valve_option">
            <fieldset>
                <p class="valve_names">{{ optionName }}</p>
                <p class="valve_names">{{ optionNumber }}</p>
            </fieldset>
            <input
                type="button"
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
                        sendStore()
                "
            />
            <input
                type="button"
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
                        sendStore()
                "
            />
            <input
                type="button"
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
                        sendStore()
                "
            />
            <input
                type="button"
                name="valve_lock"
                :value="valveLock"
                @click="lockInput = valveLock"
            />
            <!-- <textarea name="valve_memo" v-model="valveMemo"></textarea> -->
            <input
                type="button"
                value="その他オプション"
                @click="othersOption()"
            />
        </fieldset>
    </div>
</template>

<script>
export default {
    props: {
        // 弁のid。元はデータベースからの取得したデータ。
        optionId: {
            default: ""
        },
        // 以下はオプション画面で表示する情報。弁番号と弁名称。
        optionNumber: {
            default: ""
        },
        optionName: {
            default: ""
        },
        // 弁の通常状態のデータ。通常状態の表示・非表示で用いる。
        optionUsuallyState: {
            default: ""
        }
    },
    data() {
        return {
            // :valueに入っている値。
            valueOpen: "開",
            valueClose: "閉",
            valueAdjusted: "調整開",

            // クリックした弁の:value値(開・閉・調整開)が入る。上記のvalueopen/close/adjustedが入る。
            // axiosでデータベースに送ったり、Vuexのstoreにデータを渡す役割がある。
            stateInput: "",

            // axiosでDBに送るデータ
            valveLock: "保安ロック",
            lockInput: ""
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
                            valve_state: this.stateInput,
                            valve_lock: this.lockInput
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
        // 弁オプションで開閉ボタンを押した際に、Vuexのstoreに状態を登録する処理
        sendStore() {
            this.$emit("push-state-button", this.stateInput);
        },
        othersOption() {
            this.$emit("push-others-button");
        }
    }
};
</script>

<style scoped>
/* バルブオプション */
.valve_option {
    width: 200px;
    height: 600px;
    display: flex;
    justify-content: center;
    flex-direction: column;
    border-radius: 5px;
}

/* バルブオプション内の各ボタン(開閉等のボタン) */
.valve_option > input {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 30px auto;
    width: 200px;
    height: 50px;
    border-radius: 5px;
    border-bottom: solid 5px #444;
    border-right: solid 5px #444;
}

/* オプション内のメモ欄 */
.valve_option > textarea {
    width: 200px;
    height: 50px;
    border-radius: 5px;
}

.valve_names {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}
</style>
