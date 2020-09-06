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
            <!-- <form action="/SystemD" method="post"> -->
            <!-- <input type="hidden" name="_token" v-bind:value="csrf"> -->
                <div v-if="show">
                    <fieldset class="valve_option">
                        <fieldset>
                            <p class="valve_names">弁名称</p>
                            <p class="valve_names">弁番号</p>
                        </fieldset>
                        <button
                            name="valve_state"
                            @click="
                                (open = false),
                                    (close = true),
                                    (adjusted = false)
                            "
                        >
                            開
                        </button>
                        <button
                            name="valve_state"
                            @click="
                                (close = false),
                                    (open = true),
                                    (adjusted = false)
                            "
                        >
                            閉
                        </button>
                        <button
                            name="valve_state"
                            @click="
                                (close = false),
                                    (open = false),
                                    (adjusted = true)
                            "
                        >
                            調整開
                        </button>
                        <button>保安ロックへ追加</button>
                        <button>メモ</button>
                        <textarea name="valve_memo"></textarea>
                        <!-- <button type="submit">save</button> -->
                    </fieldset>
                </div>
            <!-- </form> -->
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
            adjusted: true
        };
    },
    // props: {
    //     csrf: {
    //         type: String,
    //         required: true
    //     }
    // }
};
</script>

<style scoped>
/* 通常「閉」のバルブimg */
.closeV {
    width: 5%;
    height: 5%;
    position: absolute;
    /* top: 100px;
    left: 300px; */
}

/* 通常「開」のバルブimg */
.openV {
    width: 5%;
    height: 5%;
    position: absolute;
    /* top: 100px;
    left: 300px; */
}

/* 「調整開」のバルブimg */
.adjustedV {
    width: 5%;
    height: 5%;
    position: absolute;
    /* top: 100px;
    left: 300px; */
}

/* バルブオプション */
.valve_option {
    width: 200px;
    height: 600px;
    /* display: flex;
    justify-content: center;
    flex-direction: column;
    border-radius: 5px; */
}

/* バルブオプション内の各ボタン(開閉等のボタン) */
.valve_option > button {
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
