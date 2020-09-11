<template>
    <div>
        <span>
            <!-- <span @click="show = !show"> -->
            <img
                :src="'/img/open_valve_2.png'"
                alt="弁「開」"
                class="openV"
                v-if="close"
            />
            <img
                :src="'/img/adjusted_valve_2.png'"
                alt="調整開"
                class="adjustedV"
                v-if="adjusted"
            />
            <img
                :src="'/img/close_valve_2.png'"
                alt="弁「閉」"
                class="closeV"
                v-if="open"
            />
            <div v-if="show">
                <fieldset class="valve_option">
                    <fieldset>
                        <p class="valve_names">弁名称</p>
                        <p class="valve_names">弁番号</p>
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
                                updateOption()
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
                                updateOption()
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
                                updateOption()
                        "
                    />
                    <input
                        type="button"
                        name="valve_lock"
                        :value="valveLock"
                        @click="lockInput = valveLock"
                    />
                    <textarea name="valve_memo" v-model="valveMemo"></textarea>
                    <input
                        type="button"
                        value="メモを保存"
                        @click="updateOption"
                    />
                    <button @click="updateOption">
                        DBへ送信
                    </button>
                </fieldset>
            </div>
        </span>
    </div>
</template>

<script>
export default {
    data() {
        return {
            show: true,
            // show: false,
            open: true,
            close: true,
            adjusted: true,
            valueOpen: "開",
            valueClose: "閉",
            valueAdjusted: "調整開",
            stateInput: "",
            valveMemo: "",
            valveLock: "保安ロック",
            lockInput: ""
        };
    },
    props: ["optionId"],
    methods: {
        updateOption() {
            // タイマーで遅らせる理由
            // propsに弁1番が入っている時に弁2番を操作する→弁2番の操作が弁1番の方に反映されてしまう。
            setTimeout(
                () =>
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
        }
    }
};
</script>

<style scoped>
/* 通常「閉」のバルブimg */
.closeV {
    width: 5%;
    height: 5%;
    position: absolute;
}

/* 通常「開」のバルブimg */
.openV {
    width: 5%;
    height: 5%;
    position: absolute;
}

/* 「調整開」のバルブimg */
.adjustedV {
    width: 5%;
    height: 5%;
    position: absolute;
}

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
