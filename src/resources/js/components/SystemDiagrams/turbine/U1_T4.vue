<template>
    <div>
        <v-app>
            <div @mousemove="touchmove($event)" @mouseup="touchend()">
                <div>
                    <!-- <img
                        :src="'/img/SystemDiagrams/boiler/B-4.png'"
                        alt="B-4系統線図"
                        class="b-4"
                    /> -->
                </div>
                <!-- 付箋関係 -->
                <div
                    @mousedown="touchstart()"
                    :style="memoPosition"
                    class="tag"
                >
                    <Tag :tagName="systemDiagram" :tagPosi="tag_posi"></Tag>
                </div>
                <!-- ルーペ -->
                <div>
                    <Loupe :sendSrc="imgSrc"></Loupe>
                </div>
                <!-- 系統線図の各弁をv-forで展開 -->
                <div
                    v-for="(Valve, index) in u1_t4"
                    :key="Valve.id"
                    @click="
                        getId(Valve.id),
                            getNumber(Valve.valve_number),
                            getName(Valve.valve_name),
                            getUsuallyState(Valve.valve_usually_state),
                            getMemo(Valve.valve_memo),
                            getIndex(index)
                    "
                >
                    <!-- 弁名称表示用 -->
                    <p :class="assignClass + Valve.id" class="valve_name">
                        {{ Valve.valve_number }}
                    </p>

                    <!-- v-forで展開する弁のコンポーネント -->
                    <p
                        :class="assignClass + Valve.id"
                        @click="(show = !show), (othersShow = false)"
                    >
                        <BaseValve
                            :option-id="Valve.id"
                            :open-command="openCommand"
                            :close-command="closeCommand"
                            :adjusted-command="adjustedCommand"
                            :system-diagram="systemDiagram"
                            :watchStatus="watchStatus"
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

                <!-- その他の弁オプション(弁名称・弁番号・通常状態・メモ)のコンポーネント -->
                <p v-if="othersShow">
                    <BaseSubOption
                        :option-id="sendId"
                        :option-name="sendName"
                        :option-number="sendNumber"
                        :option-usually-state="sendUsuallyState"
                        :option-memo="sendMemo"
                        :systemDiagram="systemDiagram"
                        @push-save-invisible="othersShow = false"
                        @push-save-update="pushSaveUpdate"
                        @push-save-reset="pushSaveReset"
                    ></BaseSubOption>
                </p>
            </div>
        </v-app>
    </div>
</template>

<script>
export default {
    // SystemList.blade.phpから送られてきた、ValveOptionテーブルのデータ
    props: ["u1_t4"],
    data() {
        return {
            // BaseValve.vue及びBaseSubOptionに以下のデータを送信する(弁をクリック時に送信される)
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

            // v-forで展開した各弁にclassを自動で割り振る。// 例: class="t4_3" => 系統図=t4,id=3の弁
            assignClass: "u1_t4_",

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
            systemDiagram: "u1_t4",

            // 動くメモの座標。マウスクリック時にここへ値を代入。
            tag_posi: {
                x: 0,
                y: 0
            },
            memoPositionStyles: {
                position: "absolute",
                top: "",
                left: ""
            },
            // クリックしている時だけ、trueになる。tag_posiをmemoPositionStylesに代入する際、使用。
            is_mousedown: false,

            // 弁の通常状態の表示に関するデータ。弁のidが入ってくる。
            watchStatus: "",

            imgSrc: "/img/SystemDiagrams/turbine/T-4.png"
        };
    },
    computed: {
        // (dataのmemoPositionStylesからの値を取り出し、css変数に値を代入する。)
        memoPosition() {
            return {
                "--position-top": this.memoPositionStyles.top + "px",
                "--position-left": this.memoPositionStyles.left + "px"
            };
        }
    },
    mounted() {
        //store.stateの中から、state.tagNameとこのページのsystemDiagramが同じものを探し出して、変数にいれる。
        let getStore = this.$store.state.storeTags[0].find(tagStore => {
            return tagStore.tag_name == this.systemDiagram;
        });
        // data内のsystemDiagram(系統線図名)とstoreのtagNameが同じものだけ、
        // 系統線図ページを開く時に付箋メモのポジションが反映される。
        if (this.systemDiagram == getStore.tag_name) {
            this.tag_posi.x = getStore.position_X;
            this.tag_posi.y = getStore.position_Y;
            this.memoPositionStyles.left = this.tag_posi.x - 30;
            this.memoPositionStyles.top = this.tag_posi.y - 150;
        }

        // ページを開いた時、画面がそのページにスクロールする。
        scrollTo(0, 125);
    },
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
        // BaseSubOptionの保存ボタンクリックイベント。弁の通常状態表示の切替に関する処理。
        pushSaveUpdate: function() {
            return (this.watchStatus = this.sendId);
        },
        // 上記のwatchStatusをリセットする処理。同じ弁の保存ボタンを連続で押す場合に必要な処理。
        pushSaveReset: function() {
            setTimeout(() => {
                return (this.watchStatus = "");
            }, 100);
        },
        // 弁オプションで開閉ボタンを押した際に、Vuexのstoreに状態を登録する処理
        pushStateButton(stateInput) {
            this.$store.commit("changeValveStatus", {
                id: this.sendId,
                stateInput: stateInput
            });
        },
        // クリック中だけ、座標の取得とpositionへの値の代入を行う。
        touchstart: function() {
            this.is_mousedown = true;
        },
        // 座標の取得、position用のtop,leftに座標を代入。
        touchmove: function(e) {
            if (this.is_mousedown == true) {
                this.tag_posi.x = e.pageX;
                this.tag_posi.y = e.pageY;
                this.memoPositionStyles.left = this.tag_posi.x - 30;
                this.memoPositionStyles.top = this.tag_posi.y - 150;
            }
        },
        //クリックが終わると座標をpositionに代入しなくなる。
        touchend: function() {
            this.is_mousedown = false;
        }
    }
};
</script>

<style scoped>
/* 系統線図T-8 */
.t-4 {
    width: 1400px;
    height: auto;
    padding-left: 200px;
}
/* 弁名称の表示関係のcss */
.valve_name {
    margin-top: 20px;
}
/* 弁オプション */
.valve_options {
    position: absolute;
    top: 70px;
    left: 15px;
}
/* 付箋を動かすときのポジション(css変数を使用。computedからデータが飛んでくる) */
.tag {
    position: absolute;
    top: var(--position-top);
    left: var(--position-left);
}

/* 各弁のclass */
.u1_t4_1 {
    position: absolute;
    top: 250px;
    left: 230px;
    width: 50px;
    height: 40px;
}
.u1_t4_2 {
    position: absolute;
    top: 250px;
    left: 330px;
    width: 50px;
    height: 40px;
}
.u1_t4_3 {
    position: absolute;
    top: 250px;
    left: 430px;
    width: 50px;
    height: 40px;
}
.u1_t4_4 {
    position: absolute;
    top: 250px;
    left: 530px;
    width: 50px;
    height: 40px;
}
.u1_t4_5 {
    position: absolute;
    top: 250px;
    left: 630px;
    width: 50px;
    height: 40px;
}
</style>
