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
                            type="submit"                
                            name="valve_state"
                            value="開"
                            @click="
                                (open = false),
                                    (close = true),
                                    (adjusted = false)
                            "
                        >
                        <input
                            type="submit"                
                            name="valve_state"
                            value="閉"
                            @click="
                                (close = false),
                                    (open = true),
                                    (adjusted = false)
                            "
                        >                            
                        <input
                            type="submit"                
                            name="valve_state"
                            value="調整開"
                            @click="
                                (close = false),
                                    (open = false),
                                    (adjusted = true)
                            "
                        >
                        <input type="submit" name="valve_lock" value="保安ロック"> 
                        <textarea name="valve_memo"></textarea>
                        <input type="submit" value="メモを保存">
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
            adjusted: true
        };
    },
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
