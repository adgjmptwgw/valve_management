<template>
    <div @mousemove="touchmove($event)">
        <div class="t-7">
            <img
                :src="'/img/SystemDiagrams/t-8.png'"
                alt="T-7系統線図"
                class="t-7"
            />
        </div>

        <div
            v-for="(memo, memoIndex) in memoList"
            :key="memoIndex"
            :style="styles"
            @mousedown="touchstart()"
            @mouseup="touchend()"
        >
        <!-- @mousemove.stop -->
            <textarea cols="30" rows="5"></textarea>
            <button @click="del(memoIndex)">削除</button>
        </div>
        <button @click="addMemo()">新しいメモ</button>

        <div
            v-for="(Valve, index) in u1_t1"
            :key="Valve.id"
            @click="
                getId(Valve.id),
                    getNumber(Valve.valve_number),
                    getName(Valve.valve_name),
                    getUsuallyState(Valve.valve_usually_state),
                    getMemo(Valve.valve_memo),
                    getIndex(index),
                    invisible((othersShow = false))
            "
        >
            <!-- 弁名称 -->
            <p :class="assignClass + Valve.id" class="valve_name">
                {{ Valve.valve_number }}
            </p>

            <!-- v-forで展開する弁 -->
            <p :class="assignClass + Valve.id" @click="show = !show">
                <BaseValve
                    :option-id="Valve.id"
                    :option-usually-state="Valve.valve_usually_state"
                    :open-command="openCommand"
                    :close-command="closeCommand"
                    :adjusted-command="adjustedCommand"
                    :system-diagram="systemDiagram"
                ></BaseValve>
            </p>
        </div>

        <!-- 弁オプション(開閉ボタン等)のコンポーネント。 -->
        <div v-if="show" @click="show = !show" class="valve_options">
            <ValveOption
                :option-id="sendId"
                :option-name="sendName"
                :option-number="sendNumber"
                :option-usually-state="sendUsuallyState"
                @push-open="pushOpen"
                @push-close="pushClose"
                @push-adjusted="pushAdjusted"
                @push-reset-open="pushResetOpen"
                @push-reset-close="pushResetClose"
                @push-reset-adjusted="pushResetAdjusted"
                @push-state-button="pushStateButton"
                @push-others-button="othersShow = !othersShow"
            ></ValveOption>
        </div>

        <!-- その他の弁オプション(弁名称・弁番号・通常状態・メモ) -->
        <p v-if="othersShow">
            <BaseEditInput
                :option-id="sendId"
                :option-name="sendName"
                :option-number="sendNumber"
                :option-usually-state="sendUsuallyState"
                :option-memo="sendMemo"
                @push-save-button="othersShow = false"
            ></BaseEditInput>
        </p>
    </div>
</template>

<script>
export default {
    props: {
        // SystemList.blade.phpから送られてきた、ValveOptionテーブルのデータ
        u1_t1: {
            // type: Object
            default: ""
        }
    },
    data() {
        return {
            // BaseValve.vue及びBaseEditInputに以下のデータを送信する(弁をクリック時に送信される)
            // 弁のid
            sendId: "",
            // 弁の通常状態
            sendUsuallyState: "",
            // 弁名称
            sendName: "",
            // 弁の番号
            sendNumber: "",
            // 弁のメモ
            sendMemo: "",

            // v-forで展開した各弁にclassを自動で割り振る。// 例: class="t1_3" => 系統図=t1,id=3の弁
            assignClass: "u1_t1_",

            // 弁オプションからemitで飛んできたイベントで用いる。各弁のコンポーネントにpropsで送る。
            // クリックした弁のidがこのdataの中に入っている。
            openCommand: "",
            closeCommand: "",
            adjustedCommand: "",

            // 弁オプション(valveOption)コンポーネントの表示と非表示に使用
            show: false,
            othersShow: false,

            // 上記v-forで展開した弁をクリックした際に、その弁の配列の順番をVuexのstoreへ送る。
            sendIndex: "",

            // propsでBaseValve.vueへ送る。どのstoreへデータを送るか判断する為に使用。
            systemDiagram: "u1_t1",

            // 前回のクリック座標
            prev_pos: {
                x: 0,
                y: 0
            },
            styles: {
                position: "absolute",
                top: "",
                left: "",
                zInex:1
            },
            isStyles:false,
            memoList: [],
            is_mousedown: false
        };
    },

    // ページを開いた時、画面がそのページにスクロールする。
    mounted() {
        scrollTo(0, 110);
    },
    // pushStateButton(stateInput) {
    //         this.$store.commit("changeStatus", {
    //             index: this.sendIndex,
    //             stateInput: stateInput
    //         });
    //     }
    methods: {
        // SystemList.blade.phpから送られてきたデータがv-forで展開される。v-forで展開された各idとvalve_nameを
        // propsを用いて、BaseValve.vueにデータを送信する。
        getId: function(ValveId) {
            return (this.sendId = ValveId);
        },
        getUsuallyState: function(ValveUsuallyState) {
            return (this.sendUsuallyState = ValveUsuallyState);
        },
        getNumber: function(ValveNumber) {
            return (this.sendNumber = ValveNumber);
        },
        getName: function(ValveName) {
            return (this.sendName = ValveName);
        },
        getMemo: function(ValveMemo) {
            return (this.sendMemo = ValveMemo);
        },

        // forで展開した弁をクリックした際、当該弁の繰り返し回数をstoreへ送信する。引数は繰り返し回数。
        getIndex: function(index) {
            return (this.sendIndex = index);
        },

        // 開閉ボタンを押した際、その弁のidを各BaseValve.vueに送る。
        pushOpen: function() {
            return (this.openCommand = this.sendId);
        },
        pushClose: function() {
            return (this.closeCommand = this.sendId);
        },
        pushAdjusted: function() {
            return (this.adjustedCommand = this.sendId);
        },

        // open/close/adjustedCommandのdataの中身を0.3秒後空にリセットする。
        // これをしないと、1度「開」ボタンを押した後、2度目に押しても弁の開閉表示が変わらない。
        // BaseValve.vueのwatch参照。
        pushResetOpen: function() {
            setTimeout(() => {
                return (this.openCommand = "");
            }, 100);
        },
        pushResetClose: function() {
            setTimeout(() => {
                return (this.closeCommand = "");
            }, 100);
        },
        pushResetAdjusted: function() {
            setTimeout(() => {
                return (this.adjustedCommand = "");
            }, 100);
        },
        
        // 弁オプションで開閉ボタンを押した際に、Vuexのstoreに状態を登録する処理
        pushStateButton(stateInput) {
            this.$store.commit("changeStatus", {
                id: this.sendId,
                stateInput: stateInput
                // index:this.sendIndex,
                // systemDiagram:this.systemDiagram,
            });
        },
        // 座標の取得
        touchstart: function() {
            this.is_mousedown = true;
        },
        touchmove: function(e) {
            if ((this.is_mousedown == true)) {
                this.prev_pos.x = e.pageX;
                this.prev_pos.y = e.pageY;
                this.styles.left = this.prev_pos.x;
                this.styles.top = this.prev_pos.y;
            }
        },
        touchend: function() {
            this.is_mousedown = false;
        },
        addMemo: function() {
            // メモ追加
            this.memoList.push({
                value: ""
            });
        },
        del: function(memoIndex) {
            // メモ削除
            this.memoList.splice(memoIndex, 1);
        },     
    }
};
</script>

<style scoped>
/* 系統線図T-7 */
.t-7 {
    width: 1200px;
    height: auto;
    padding-left: 100px;
}
/* 各弁のclass */
.u1_t1_1 {
    position: absolute;
    top: 250px;
    left: 230px;
}
.u1_t1_2 {
    position: absolute;
    top: 250px;
    left: 330px;
}
.u1_t1_3 {
    position: absolute;
    top: 250px;
    left: 430px;
}
.u1_t1_4 {
    position: absolute;
    top: 250px;
    left: 530px;
}
.u1_t1_5 {
    position: absolute;
    top: 250px;
    left: 630px;
}
/* 弁名称の表示関係のcss */
.valve_name {
    margin-top: 20px;
}
.valve_options {
    position: absolute;
    top: 200px;
    left: 0px;
}
/* .tag{
    position: absolute;
    top: 125px;
    left: 200px;
} */
</style>