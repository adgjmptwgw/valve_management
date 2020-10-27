<template>
    <v-app class="whole_page">
        <!-- 付箋の座標を取得するマウスイベント -->
        <div @mousemove="touchmove($event)" @mouseup="touchend()">
            <!-- 付箋コンポーネント -->
            <!-- @mousemove.stop -->
            <div @mousedown="touchstart()" :style="memoPosition" class="tag">
                <Tag :tagName="systemDiagram" :tagPosi="tag_posi"></Tag>
            </div>
            <!-- ルーペコンポーネント -->
            <div>
                <Loupe :sendSrc="imgSrc"></Loupe>
            </div>
            <!-- 系統線図の各弁をv-forで展開 -->
            <div
                v-for="(Valve, index) in u1_b4"
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
                <!-- v-forで展開する弁(バルブ)コンポーネント -->
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

            <!-- 弁(バルブ)オプション(開閉ボタン等)のコンポーネント。 -->
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

            <!-- その他の弁(バルブ)オプション(弁名称・弁番号・通常状態・メモ)のコンポーネント -->
            <p v-if="othersShow">
                <BaseSubOption
                    :option-id="sendId"
                    :systemDiagram="systemDiagram"
                    @push-save-invisible="othersShow = false"
                    @push-save-update="pushSaveUpdate"
                    @push-save-reset="pushSaveReset"
                ></BaseSubOption>
            </p>
        </div>
        <!-- 系統線図毎の弁のポジションや大きさに関するCSSの読み込み -->
        <link
            rel="stylesheet"
            type="text/css"
            href="/css/SystemDiagram/boiler/B-4.css"
        />
    </v-app>
</template>

<script>
export default {
    // SystemList.blade.phpから送られてきた、ValveOptionテーブルのデータ
    props: ["u1_b4"],
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

            // v-forで展開した各弁にclassを自動で割り振る。// 例: class="u1_b4_1" => 1号B-4,id=1の弁
            assignClass: "u1_b4_",

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
            systemDiagram: "u1_b4",

            // 動くメモの座標。マウスクリック時にここへ値を代入。
            tag_posi: {
                x: 0,
                y: 0
            },
            memoPositionStyles: {
                position: "absolute",
                top: this.$store.state.storeTags[0].position_X,
                left: this.$store.state.storeTags[0].position_Y,
            },
            // クリックしている時だけ、trueになる。tag_posiをmemoPositionStylesに代入する際、使用。
            is_mousedown: false,

            // 弁の通常状態の表示に関するデータ。弁のidが入ってくる。
            watchStatus: "",

            // Loupe.vueにpropsで送る系統線図のsrc
            imgSrc: "/img/SystemDiagrams/boiler/B-4.png"
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
    created() {
        // ページを開いた時、画面がそのページにスクロールする。
        scrollTo(0, 125);
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
/* ページ全体のcss */
.whole_page{
    height: 1100px;
}
/* 弁オプション */
.valve_options {
    position: absolute;
    top: 50px;
    left: 15px;
}
/* 付箋を動かすときのポジション(css変数を使用。computedからデータが飛んでくる) */
.tag {
    position: absolute;
    top: var(--position-top);
    left: var(--position-left);
    z-index: 1;
}
/* 各弁のポジションとサイズ */
.u1_b4_1 {
    position: absolute;
    top: 702px;
    left: 943px;
    width: 6.5px;
    height: 5px;
}

.u1_b4_2 {
    position: absolute;
    top: 737px;
    left: 943px;
    width: 6.5px;
    height: 5px;
}

.u1_b4_3 {
    position: absolute;
    top: 771px;
    left: 943px;
    width: 6.5px;
    height: 5px;
}

.u1_b4_4 {
    position: absolute;
    top: 771px;
    left: 907px;
    width: 6.5px;
    height: 5px;
}

.u1_b4_5 {
    position: absolute;
    top: 683px;
    left: 890px;
    width: 7px;
    height: 6.3px;
    transform: rotate(-45deg);
}

.u1_b4_6 {
    position: absolute;
    top: 718px;
    left: 890px;
    width: 7px;
    height: 6.3px;
    transform: rotate(-45deg);
}

.u1_b4_7 {
    position: absolute;
    top: 752px;
    left: 890px;
    width: 7px;
    height: 6.3px;
    transform: rotate(-45deg);
}

.u1_b4_8 {
    position: absolute;
    top: 794px;
    left: 964px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_9 {
    position: absolute;
    top: 794px;
    left: 1024px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_10 {
    position: absolute;
    top: 714px;
    left: 974px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_11 {
    position: absolute;
    top: 726px;
    left: 995px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_12 {
    position: absolute;
    top: 737px;
    left: 995px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_13 {
    position: absolute;
    top: 747px;
    left: 995px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_14 {
    position: absolute;
    top: 726px;
    left: 1021px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_15 {
    position: absolute;
    top: 743px;
    left: 1122px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_16 {
    position: absolute;
    top: 753px;
    left: 1122px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_17 {
    position: absolute;
    top: 696px;
    left: 915px;
    width: 6px;
    height: 5.4px;
    transform: rotate(90deg);
}

.u1_b4_18 {
    position: absolute;
    top: 690px;
    left: 915px;
    width: 6px;
    height: 5.4px;
    transform: rotate(90deg);
}

.u1_b4_19 {
    position: absolute;
    top: 690px;
    left: 934px;
    width: 6px;
    height: 5.4px;
    transform: rotate(90deg);
}

.u1_b4_20 {
    position: absolute;
    top: 695px;
    left: 934px;
    width: 6px;
    height: 5.4px;
    transform: rotate(90deg);
}

.u1_b4_21 {
    position: absolute;
    top: 730px;
    left: 915px;
    width: 6px;
    height: 5.4px;
    transform: rotate(90deg);
}

.u1_b4_22 {
    position: absolute;
    top: 725px;
    left: 915px;
    width: 6px;
    height: 5.4px;
    transform: rotate(90deg);
}

.u1_b4_23 {
    position: absolute;
    top: 725px;
    left: 934px;
    width: 6px;
    height: 5.4px;
    transform: rotate(90deg);
}

.u1_b4_24 {
    position: absolute;
    top: 731px;
    left: 934px;
    width: 6px;
    height: 5.4px;
    transform: rotate(90deg);
}

.u1_b4_25 {
    position: absolute;
    top: 765px;
    left: 915px;
    width: 6px;
    height: 5.4px;
    transform: rotate(90deg);
}

.u1_b4_26 {
    position: absolute;
    top: 760px;
    left: 915px;
    width: 6px;
    height: 5.4px;
    transform: rotate(90deg);
}

.u1_b4_27 {
    position: absolute;
    top: 760px;
    left: 934px;
    width: 6px;
    height: 5.4px;
    transform: rotate(90deg);
}

.u1_b4_28 {
    position: absolute;
    top: 765px;
    left: 934px;
    width: 6px;
    height: 5.4px;
    transform: rotate(90deg);
}

.u1_b4_29 {
    position: absolute;
    top: 765px;
    left: 1071px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_30 {
    position: absolute;
    top: 730px;
    left: 1129px;
    width: 5px;
    height: 4.5px;
}

.u1_b4_31 {
    position: absolute;
    top: 730px;
    left: 1134px;
    width: 5px;
    height: 4.5px;
}

.u1_b4_32 {
    position: absolute;
    top: 711px;
    left: 1134px;
    width: 5px;
    height: 4.5px;
}

.u1_b4_33 {
    position: absolute;
    top: 711px;
    left: 1129px;
    width: 5px;
    height: 4.5px;
}

.u1_b4_34 {
    position: absolute;
    top: 609px;
    left: 958px;
    width: 6px;
    height: 5.4px;
}

.u1_b4_35 {
    position: absolute;
    top: 609px;
    left: 1045px;
    width: 6px;
    height: 5.4px;
}

.u1_b4_36 {
    position: absolute;
    top: 654px;
    left: 958px;
    width: 6px;
    height: 5.4px;
}

.u1_b4_37 {
    position: absolute;
    top: 654px;
    left: 1045px;
    width: 6px;
    height: 5.4px;
}

.u1_b4_38 {
    position: absolute;
    top: 635px;
    left: 1001px;
    width: 6px;
    height: 5.4px;
}

.u1_b4_39 {
    position: absolute;
    top: 652px;
    left: 1109px;
    width: 6px;
    height: 5.4px;
    transform: rotate(90deg);
}

.u1_b4_40 {
    position: absolute;
    top: 652px;
    left: 1122px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_41 {
    position: absolute;
    top: 623px;
    left: 1115px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_42 {
    position: absolute;
    top: 612px;
    left: 1115px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_43 {
    position: absolute;
    top: 628px;
    left: 1143px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_44 {
    position: absolute;
    top: 628px;
    left: 1187px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_45 {
    position: absolute;
    top: 621px;
    left: 1150px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_46 {
    position: absolute;
    top: 621px;
    left: 1181px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_47 {
    position: absolute;
    top: 651px;
    left: 1204px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_48 {
    position: absolute;
    top: 648px;
    left: 1223px;
    width: 6px;
    height: 5.4px;
    transform: rotate(90deg);
}

.u1_b4_49 {
    position: absolute;
    top: 660px;
    left: 1208px;
    width: 6px;
    height: 5.4px;
    transform: rotate(90deg);
}

.u1_b4_50 {
    position: absolute;
    top: 643px;
    left: 1208px;
    width: 6px;
    height: 5.4px;
    transform: rotate(90deg);
}

.u1_b4_51 {
    position: absolute;
    top: 658px;
    left: 1243px;
    width: 6px;
    height: 5.4px;
    transform: rotate(90deg);
}

.u1_b4_52 {
    position: absolute;
    top: 653px;
    left: 1243px;
    width: 6px;
    height: 5.4px;
    transform: rotate(90deg);
}

.u1_b4_53 {
    position: absolute;
    top: 653px;
    left: 1262px;
    width: 6px;
    height: 5.4px;
    transform: rotate(90deg);
}

.u1_b4_54 {
    position: absolute;
    top: 659px;
    left: 1262px;
    width: 6px;
    height: 5.4px;
    transform: rotate(90deg);
}

.u1_b4_55 {
    position: absolute;
    top: 665px;
    left: 1285px;
    width: 6px;
    height: 5.4px;
    transform: rotate(90deg);
}

.u1_b4_56 {
    position: absolute;
    top: 670px;
    left: 1285px;
    width: 6px;
    height: 5.4px;
    transform: rotate(90deg);
}

.u1_b4_57 {
    position: absolute;
    top: 670px;
    left: 1304px;
    width: 6px;
    height: 5.4px;
    transform: rotate(90deg);
}

.u1_b4_58 {
    position: absolute;
    top: 665px;
    left: 1304px;
    width: 6px;
    height: 5.4px;
    transform: rotate(90deg);
}

.u1_b4_59 {
    position: absolute;
    top: 571px;
    left: 1311px;
    width: 6px;
    height: 5.4px;
    transform: rotate(90deg);
}

.u1_b4_60 {
    position: absolute;
    top: 537px;
    left: 1311px;
    width: 6px;
    height: 5.4px;
    transform: rotate(90deg);
}

.u1_b4_61 {
    position: absolute;
    top: 525px;
    left: 1311px;
    width: 6px;
    height: 5.4px;
    transform: rotate(90deg);
}

.u1_b4_62 {
    position: absolute;
    top: 512px;
    left: 1311px;
    width: 6px;
    height: 5.4px;
    transform: rotate(90deg);
}

.u1_b4_63 {
    position: absolute;
    top: 524px;
    left: 1295px;
    width: 6px;
    height: 5.4px;
    transform: rotate(90deg);
}

.u1_b4_64 {
    position: absolute;
    top: 606px;
    left: 1277px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_65 {
    position: absolute;
    top: 600px;
    left: 1177px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_66 {
    position: absolute;
    top: 600px;
    left: 1240px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_67 {
    position: absolute;
    top: 589px;
    left: 1164px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_68 {
    position: absolute;
    top: 555px;
    left: 1062px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_69 {
    position: absolute;
    top: 555px;
    left: 1074px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_70 {
    position: absolute;
    top: 555px;
    left: 1084px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_71 {
    position: absolute;
    top: 518px;
    left: 1215px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_72 {
    position: absolute;
    top: 518px;
    left: 1243px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_73 {
    position: absolute;
    top: 518px;
    left: 1185px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_74 {
    position: absolute;
    top: 518px;
    left: 1159px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_75 {
    position: absolute;
    top: 493px;
    left: 1215px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_76 {
    position: absolute;
    top: 493px;
    left: 1243px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_77 {
    position: absolute;
    top: 493px;
    left: 1185px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_78 {
    position: absolute;
    top: 493px;
    left: 1159px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_79 {
    position: absolute;
    top: 433px;
    left: 1272px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_80 {
    position: absolute;
    top: 423px;
    left: 1272px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_81 {
    position: absolute;
    top: 411px;
    left: 1272px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_82 {
    position: absolute;
    top: 398px;
    left: 1296px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_83 {
    position: absolute;
    top: 385px;
    left: 1296px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_84 {
    position: absolute;
    top: 372px;
    left: 1296px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_85 {
    position: absolute;
    top: 398px;
    left: 1254px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_86 {
    position: absolute;
    top: 386px;
    left: 1254px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_87 {
    position: absolute;
    top: 372px;
    left: 1254px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_88 {
    position: absolute;
    top: 385px;
    left: 1237px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_89 {
    position: absolute;
    top: 411px;
    left: 1282px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_90 {
    position: absolute;
    top: 400px;
    left: 1282px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_91 {
    position: absolute;
    top: 389px;
    left: 1282px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_92 {
    position: absolute;
    top: 401px;
    left: 1292px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_92 {
    position: absolute;
    top: 401px;
    left: 1292px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_92 {
    position: absolute;
    top: 401px;
    left: 1292px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_93 {
    position: absolute;
    top: 428px;
    left: 660px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_94 {
    position: absolute;
    top: 428px;
    left: 626px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_95 {
    position: absolute;
    top: 428px;
    left: 593px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_96 {
    position: absolute;
    top: 428px;
    left: 559px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_97 {
    position: absolute;
    top: 465px;
    left: 660px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_98 {
    position: absolute;
    top: 475px;
    left: 660px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_99 {
    position: absolute;
    top: 513px;
    left: 660px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_100 {
    position: absolute;
    top: 502px;
    left: 660px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_101 {
    position: absolute;
    top: 465px;
    left: 560px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_102 {
    position: absolute;
    top: 475px;
    left: 560px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_103 {
    position: absolute;
    top: 513px;
    left: 560px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_104 {
    position: absolute;
    top: 502px;
    left: 560px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_105 {
    position: absolute;
    top: 465px;
    left: 627px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_106 {
    position: absolute;
    top: 475px;
    left: 627px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_107 {
    position: absolute;
    top: 513px;
    left: 627px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_108 {
    position: absolute;
    top: 502px;
    left: 627px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_109 {
    position: absolute;
    top: 465px;
    left: 677px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_110 {
    position: absolute;
    top: 475px;
    left: 677px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_111 {
    position: absolute;
    top: 465px;
    left: 537px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_112 {
    position: absolute;
    top: 475px;
    left: 537px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_113 {
    position: absolute;
    top: 506px;
    left: 414px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_114 {
    position: absolute;
    top: 506px;
    left: 403px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_115 {
    position: absolute;
    top: 506px;
    left: 391px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_116 {
    position: absolute;
    top: 506px;
    left: 414px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_117 {
    position: absolute;
    top: 512px;
    left: 428px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_118 {
    position: absolute;
    top: 506px;
    left: 332px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_119 {
    position: absolute;
    top: 506px;
    left: 321px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_120 {
    position: absolute;
    top: 512px;
    left: 358px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_121 {
    position: absolute;
    top: 740px;
    left: 391px;
    width: 8px;
    height: 7.2px;
}

.u1_b4_122 {
    position: absolute;
    top: 753px;
    left: 391px;
    width: 8px;
    height: 7.2px;
}

.u1_b4_123 {
    position: absolute;
    top: 773px;
    left: 688px;
    width: 8px;
    height: 7.2px;
}

.u1_b4_124 {
    position: absolute;
    top: 509px;
    left: 726px;
    width: 9px;
    height: 8.1px;
    transform: rotate(-45deg);
}

.u1_b4_125 {
    position: absolute;
    top: 522px;
    left: 742px;
    width: 9px;
    height: 8.1px;
    transform: rotate(-45deg);
}

.u1_b4_126 {
    position: absolute;
    top: 542px;
    left: 725px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_127 {
    position: absolute;
    top: 441px;
    left: 412px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_128 {
    position: absolute;
    top: 287px;
    left: 388px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_129 {
    position: absolute;
    top: 272px;
    left: 388px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_130 {
    position: absolute;
    top: 374px;
    left: 536px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_131 {
    position: absolute;
    top: 374px;
    left: 711px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_132 {
    position: absolute;
    top: 403px;
    left: 724px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_133 {
    position: absolute;
    top: 403px;
    left: 742px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_134 {
    position: absolute;
    top: 296px;
    left: 760px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_135 {
    position: absolute;
    top: 296px;
    left: 794px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_136 {
    position: absolute;
    top: 309px;
    left: 741px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_137 {
    position: absolute;
    top: 309px;
    left: 760px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_138 {
    position: absolute;
    top: 368px;
    left: 741px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_139 {
    position: absolute;
    top: 368px;
    left: 760px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_140 {
    position: absolute;
    top: 381px;
    left: 760px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_141 {
    position: absolute;
    top: 381px;
    left: 793px;
    width: 8px;
    height: 7.2px;
}

.u1_b4_142 {
    position: absolute;
    top: 382px;
    left: 811px;
    width: 7px;
    height: 6.3px;
    transform: rotate(45deg);
}

.u1_b4_143 {
    position: absolute;
    top: 397px;
    left: 812px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_144 {
    position: absolute;
    top: 408px;
    left: 812px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_145 {
    position: absolute;
    top: 397px;
    left: 793px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_146 {
    position: absolute;
    top: 408px;
    left: 793px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_147 {
    position: absolute;
    top: 419px;
    left: 743px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_148 {
    position: absolute;
    top: 438px;
    left: 505px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_149 {
    position: absolute;
    top: 296px;
    left: 488px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_150 {
    position: absolute;
    top: 296px;
    left: 455px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_151 {
    position: absolute;
    top: 294px;
    left: 425px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_152 {
    position: absolute;
    top: 305px;
    left: 425px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_153 {
    position: absolute;
    top: 316px;
    left: 425px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_154 {
    position: absolute;
    top: 326px;
    left: 425px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_155 {
    position: absolute;
    top: 337px;
    left: 425px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_156 {
    position: absolute;
    top: 349px;
    left: 425px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_157 {
    position: absolute;
    top: 359px;
    left: 437px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_158 {
    position: absolute;
    top: 309px;
    left: 507px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_159 {
    position: absolute;
    top: 309px;
    left: 488px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_160 {
    position: absolute;
    top: 368px;
    left: 507px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_161 {
    position: absolute;
    top: 368px;
    left: 488px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_162 {
    position: absolute;
    top: 381px;
    left: 488px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_163 {
    position: absolute;
    top: 381px;
    left: 456px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_164 {
    position: absolute;
    top: 382px;
    left: 437px;
    width: 8px;
    height: 7.2px;
    transform: rotate(-45deg);
}

.u1_b4_165 {
    position: absolute;
    top: 417px;
    left: 436px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_166 {
    position: absolute;
    top: 427px;
    left: 436px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_167 {
    position: absolute;
    top: 417px;
    left: 455px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_168 {
    position: absolute;
    top: 427px;
    left: 455px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_169 {
    position: absolute;
    top: 284px;
    left: 576px;
    width: 8px;
    height: 7.2px;
    transform: rotate(90deg);
}

.u1_b4_170 {
    position: absolute;
    top: 259px;
    left: 576px;
    width: 8px;
    height: 7.2px;
    transform: rotate(90deg);
}

.u1_b4_171 {
    position: absolute;
    top: 259px;
    left: 560px;
    width: 8px;
    height: 7.2px;
    transform: rotate(90deg);
}

.u1_b4_172 {
    position: absolute;
    top: 263px;
    left: 548px;
    width: 8px;
    height: 7.2px;
    transform: rotate(90deg);
}

.u1_b4_173 {
    position: absolute;
    top: 249px;
    left: 548px;
    width: 8px;
    height: 7.2px;
    transform: rotate(90deg);
}

.u1_b4_174 {
    position: absolute;
    top: 259px;
    left: 504px;
    width: 8px;
    height: 7.2px;
    transform: rotate(90deg);
}

.u1_b4_175 {
    position: absolute;
    top: 242px;
    left: 504px;
    width: 8px;
    height: 7.2px;
    transform: rotate(90deg);
}

.u1_b4_176 {
    position: absolute;
    top: 242px;
    left: 491px;
    width: 8px;
    height: 7.2px;
    transform: rotate(90deg);
}

.u1_b4_177 {
    position: absolute;
    top: 268px;
    left: 622px;
    width: 8px;
    height: 7.2px;
    transform: rotate(90deg);
}

.u1_b4_178 {
    position: absolute;
    top: 256px;
    left: 622px;
    width: 8px;
    height: 7.2px;
    transform: rotate(90deg);
}

.u1_b4_179 {
    position: absolute;
    top: 288px;
    left: 637px;
    width: 8px;
    height: 7.2px;
    transform: rotate(90deg);
}

.u1_b4_180 {
    position: absolute;
    top: 300px;
    left: 637px;
    width: 8px;
    height: 7.2px;
    transform: rotate(90deg);
}

.u1_b4_181 {
    position: absolute;
    top: 284px;
    left: 683px;
    width: 8px;
    height: 7.2px;
    transform: rotate(90deg);
}

.u1_b4_182 {
    position: absolute;
    top: 259px;
    left: 683px;
    width: 8px;
    height: 7.2px;
    transform: rotate(90deg);
}

.u1_b4_183 {
    position: absolute;
    top: 259px;
    left: 695px;
    width: 8px;
    height: 7.2px;
    transform: rotate(90deg);
}

.u1_b4_184 {
    position: absolute;
    top: 267px;
    left: 711px;
    width: 8px;
    height: 7.2px;
    transform: rotate(90deg);
}

.u1_b4_185 {
    position: absolute;
    top: 253px;
    left: 711px;
    width: 8px;
    height: 7.2px;
    transform: rotate(90deg);
}

.u1_b4_186 {
    position: absolute;
    top: 267px;
    left: 726px;
    width: 8px;
    height: 7.2px;
    transform: rotate(90deg);
}

.u1_b4_187 {
    position: absolute;
    top: 240px;
    left: 726px;
    width: 8px;
    height: 7.2px;
    transform: rotate(90deg);
}

.u1_b4_188 {
    position: absolute;
    top: 240px;
    left: 739px;
    width: 8px;
    height: 7.2px;
    transform: rotate(90deg);
}

.u1_b4_189 {
    position: absolute;
    top: 240px;
    left: 751px;
    width: 8px;
    height: 7.2px;
    transform: rotate(90deg);
}

.u1_b4_190 {
    position: absolute;
    top: 240px;
    left: 764px;
    width: 8px;
    height: 7.2px;
    transform: rotate(90deg);
}

.u1_b4_191 {
    position: absolute;
    top: 254px;
    left: 759px;
    width: 8px;
    height: 7.2px;
    transform: rotate(90deg);
}

.u1_b4_192 {
    position: absolute;
    top: 267px;
    left: 759px;
    width: 8px;
    height: 7.2px;
    transform: rotate(90deg);
}

.u1_b4_193 {
    position: absolute;
    top: 243px;
    left: 631px;
    width: 8px;
    height: 7.2px;
}

.u1_b4_194 {
    position: absolute;
    top: 243px;
    left: 643px;
    width: 8px;
    height: 7.2px;
}

.u1_b4_195 {
    position: absolute;
    top: 363px;
    left: 836px;
    width: 8px;
    height: 7.2px;
}

.u1_b4_196 {
    position: absolute;
    top: 363px;
    left: 973px;
    width: 8px;
    height: 7.2px;
}

.u1_b4_197 {
    position: absolute;
    top: 410px;
    left: 990px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_198 {
    position: absolute;
    top: 410px;
    left: 999px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_199 {
    position: absolute;
    top: 410px;
    left: 1008px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_200 {
    position: absolute;
    top: 410px;
    left: 1017px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_201 {
    position: absolute;
    top: 410px;
    left: 1040px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_202 {
    position: absolute;
    top: 410px;
    left: 1049px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_203 {
    position: absolute;
    top: 410px;
    left: 1058px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_204 {
    position: absolute;
    top: 410px;
    left: 1067px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_205 {
    position: absolute;
    top: 410px;
    left: 1076px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_206 {
    position: absolute;
    top: 410px;
    left: 1087px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_207 {
    position: absolute;
    top: 410px;
    left: 1097px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_208 {
    position: absolute;
    top: 410px;
    left: 1109px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_209 {
    position: absolute;
    top: 332px;
    left: 1139px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_210 {
    position: absolute;
    top: 371px;
    left: 1139px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_211 {
    position: absolute;
    top: 267px;
    left: 1227px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_212 {
    position: absolute;
    top: 267px;
    left: 1196px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_213 {
    position: absolute;
    top: 267px;
    left: 1168px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_214 {
    position: absolute;
    top: 267px;
    left: 1142px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_215 {
    position: absolute;
    top: 276px;
    left: 1234px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_216 {
    position: absolute;
    top: 276px;
    left: 1203px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_217 {
    position: absolute;
    top: 276px;
    left: 1175px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_218 {
    position: absolute;
    top: 276px;
    left: 1149px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_219 {
    position: absolute;
    top: 299px;
    left: 1145px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_220 {
    position: absolute;
    top: 157px;
    left: 1241px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_221 {
    position: absolute;
    top: 137px;
    left: 1241px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_222 {
    position: absolute;
    top: 130px;
    left: 1211px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_223 {
    position: absolute;
    top: 110px;
    left: 1211px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_224 {
    position: absolute;
    top: 220px;
    left: 1182px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_225 {
    position: absolute;
    top: 200px;
    left: 1182px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_226 {
    position: absolute;
    top: 196px;
    left: 1157px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_227 {
    position: absolute;
    top: 177px;
    left: 1157px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_228 {
    position: absolute;
    top: 94px;
    left: 1121px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_229 {
    position: absolute;
    top: 107px;
    left: 1121px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_230 {
    position: absolute;
    top: 241px;
    left: 1110px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_231 {
    position: absolute;
    top: 241px;
    left: 1082px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_232 {
    position: absolute;
    top: 241px;
    left: 1063px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_233 {
    position: absolute;
    top: 241px;
    left: 1016px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_234 {
    position: absolute;
    top: 241px;
    left: 1082px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_235 {
    position: absolute;
    top: 201px;
    left: 1084px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_236 {
    position: absolute;
    top: 186px;
    left: 1084px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_237 {
    position: absolute;
    top: 173px;
    left: 1084px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_238 {
    position: absolute;
    top: 155px;
    left: 1084px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_239 {
    position: absolute;
    top: 142px;
    left: 1084px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_240 {
    position: absolute;
    top: 126px;
    left: 1084px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_241 {
    position: absolute;
    top: 114px;
    left: 1084px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_242 {
    position: absolute;
    top: 108px;
    left: 1071px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_243 {
    position: absolute;
    top: 225px;
    left: 1071px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_244 {
    position: absolute;
    top: 138px;
    left: 1035px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_245 {
    position: absolute;
    top: 117px;
    left: 1017px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_246 {
    position: absolute;
    top: 105px;
    left: 1017px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_247 {
    position: absolute;
    top: 117px;
    left: 998px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_248 {
    position: absolute;
    top: 105px;
    left: 998px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_249 {
    position: absolute;
    top: 133px;
    left: 1008px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_250 {
    position: absolute;
    top: 133px;
    left: 989px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_251 {
    position: absolute;
    top: 214px;
    left: 1011px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_252 {
    position: absolute;
    top: 214px;
    left: 992px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_253 {
    position: absolute;
    top: 238px;
    left: 943px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_254 {
    position: absolute;
    top: 226px;
    left: 943px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_255 {
    position: absolute;
    top: 128px;
    left: 936px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_256 {
    position: absolute;
    top: 116px;
    left: 936px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_257 {
    position: absolute;
    top: 90px;
    left: 914px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_258 {
    position: absolute;
    top: 90px;
    left: 965px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_259 {
    position: absolute;
    top: 88px;
    left: 937px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_260 {
    position: absolute;
    top: 76px;
    left: 926px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_261 {
    position: absolute;
    top: 76px;
    left: 954px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_262 {
    position: absolute;
    top: 135px;
    left: 886px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_263 {
    position: absolute;
    top: 116px;
    left: 886px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_264 {
    position: absolute;
    top: 135px;
    left: 858px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_265 {
    position: absolute;
    top: 115px;
    left: 858px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_266 {
    position: absolute;
    top: 134px;
    left: 835px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_267 {
    position: absolute;
    top: 119px;
    left: 835px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_268 {
    position: absolute;
    top: 119px;
    left: 822px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_269 {
    position: absolute;
    top: 167px;
    left: 804px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_270 {
    position: absolute;
    top: 147px;
    left: 804px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_270 {
    position: absolute;
    top: 147px;
    left: 804px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_271 {
    position: absolute;
    top: 140px;
    left: 767px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_272 {
    position: absolute;
    top: 140px;
    left: 754px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_273 {
    position: absolute;
    top: 128px;
    left: 754px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_274 {
    position: absolute;
    top: 156px;
    left: 777px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_275 {
    position: absolute;
    top: 89px;
    left: 633px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_276 {
    position: absolute;
    top: 109px;
    left: 633px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_277 {
    position: absolute;
    top: 109px;
    left: 614px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_278 {
    position: absolute;
    top: 148px;
    left: 640px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_279 {
    position: absolute;
    top: 167px;
    left: 640px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_280 {
    position: absolute;
    top: 148px;
    left: 621px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_281 {
    position: absolute;
    top: 144px;
    left: 715px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_282 {
    position: absolute;
    top: 130px;
    left: 715px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_283 {
    position: absolute;
    top: 130px;
    left: 702px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_284 {
    position: absolute;
    top: 145px;
    left: 667px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_285 {
    position: absolute;
    top: 130px;
    left: 667px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_286 {
    position: absolute;
    top: 164px;
    left: 602px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_287 {
    position: absolute;
    top: 164px;
    left: 557px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_288 {
    position: absolute;
    top: 171px;
    left: 595px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_289 {
    position: absolute;
    top: 171px;
    left: 564px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_290 {
    position: absolute;
    top: 195px;
    left: 446px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_291 {
    position: absolute;
    top: 195px;
    left: 461px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_292 {
    position: absolute;
    top: 195px;
    left: 503px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_293 {
    position: absolute;
    top: 196px;
    left: 545px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_294 {
    position: absolute;
    top: 169px;
    left: 520px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_295 {
    position: absolute;
    top: 183px;
    left: 520px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_296 {
    position: absolute;
    top: 177px;
    left: 496px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_297 {
    position: absolute;
    top: 177px;
    left: 486px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_298 {
    position: absolute;
    top: 145px;
    left: 526px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_299 {
    position: absolute;
    top: 130px;
    left: 526px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_300 {
    position: absolute;
    top: 134px;
    left: 486px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_301 {
    position: absolute;
    top: 144px;
    left: 486px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_302 {
    position: absolute;
    top: 206px;
    left: 431px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_303 {
    position: absolute;
    top: 216px;
    left: 431px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_304 {
    position: absolute;
    top: 121px;
    left: 361px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_305 {
    position: absolute;
    top: 111px;
    left: 361px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_306 {
    position: absolute;
    top: 111px;
    left: 408px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_307 {
    position: absolute;
    top: 121px;
    left: 408px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_308 {
    position: absolute;
    top: 96px;
    left: 428px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_309 {
    position: absolute;
    top: 96px;
    left: 449px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_310 {
    position: absolute;
    top: 107px;
    left: 449px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_311 {
    position: absolute;
    top: 151px;
    left: 365px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_312 {
    position: absolute;
    top: 151px;
    left: 355px;
    width: 7px;
    height: 6.3px;
}

.u1_b4_313 {
    position: absolute;
    top: 213px;
    left: 384px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_314 {
    position: absolute;
    top: 213px;
    left: 366px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_315 {
    position: absolute;
    top: 213px;
    left: 312px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_316 {
    position: absolute;
    top: 238px;
    left: 384px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_317 {
    position: absolute;
    top: 238px;
    left: 366px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_318 {
    position: absolute;
    top: 238px;
    left: 312px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_319 {
    position: absolute;
    top: 238px;
    left: 325px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_320 {
    position: absolute;
    top: 268px;
    left: 312px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_321 {
    position: absolute;
    top: 295px;
    left: 299px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_322 {
    position: absolute;
    top: 313px;
    left: 299px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_323 {
    position: absolute;
    top: 341px;
    left: 288px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_324 {
    position: absolute;
    top: 358px;
    left: 288px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_325 {
    position: absolute;
    top: 242px;
    left: 517px;
    width: 8px;
    height: 7.2px;
    transform: rotate(90deg);
}

.u1_b4_326 {
    position: absolute;
    top: 273px;
    left: 517px;
    width: 8px;
    height: 7.2px;
}

.u1_b4_327 {
    position: absolute;
    top: 273px;
    left: 504px;
    width: 8px;
    height: 7.2px;
}

.u1_b4_328 {
    position: absolute;
    top: 734px;
    left: 1103px;
    width: 8px;
    height: 7.2px;
    transform: rotate(-45deg);
}

.u1_b4_329 {
    position: absolute;
    top: 159px;
    left: 934px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_330 {
    position: absolute;
    top: 148px;
    left: 968px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_331 {
    position: absolute;
    top: 145px;
    left: 981px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_332 {
    position: absolute;
    top: 258px;
    left: 916px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_333 {
    position: absolute;
    top: 258px;
    left: 888px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_334 {
    position: absolute;
    top: 258px;
    left: 860px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}

.u1_b4_335 {
    position: absolute;
    top: 257px;
    left: 851px;
    width: 7px;
    height: 6.3px;
    transform: rotate(90deg);
}
.u1_b4_336 {
    position: absolute;
    top: 756px;
    left: 1018px;
    width: 9px;
    height: 8.1px;
    transform: rotate(-45deg);
}

</style>
