<template>
    <div>
        <fieldset class="valve_option" @click="show = !show">
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
                        resetOpen()
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
                        resetClose()
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
                        resetAdjusted()
                "
            />
            <input
                type="button"
                name="valve_lock"
                :value="valveLock"
                @click="lockInput = valveLock"
            />
            <textarea name="valve_memo" v-model="valveMemo"></textarea>
            <input type="button" value="メモを保存" @click="updateOption" />
        </fieldset>
    </div>
</template>

<script>
export default {
    props: {
        optionId: {
            default: ""
        },
        optionNumber: {
            default: ""
        },
        optionName: {
            default: ""
        },
        optionUsuallyState: {
            default: ""
        }
    },
    data() {
        return {
            valueOpen: "開",
            valueClose: "閉",
            valueAdjusted: "調整開",
            stateInput: "",
            valveMemo: "",
            valveLock: "保安ロック",
            lockInput: "",
            optionNumber: "23"
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
                            // .put("/api/System/" + 1, {
                            valve_state: this.stateInput,
                            valve_lock: this.lockInput,
                            valve_memo: this.valveMemo
                        })
                        .then(response => {
                            console.log(response);
                        }),
                200
            );
        },
        commandOpen() {
            this.$emit("push-open");
        },
        commandClose() {
            this.$emit("push-close");
        },
        commandAdjusted() {
            this.$emit("push-adjusted");
        },
        resetOpen() {
            this.$emit("push-reset-open");
        },
        resetClose() {
            this.$emit("push-reset-close");
        },
        resetAdjusted() {
            this.$emit("push-reset-adjusted");
        },
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
