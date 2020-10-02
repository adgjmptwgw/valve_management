<template>
    <div>
        <!-- <div>
            <img
                :src="'/img/SystemDiagrams/t-7.png'"
                alt="T-7系統線図"
                class="t-7"
            />
        </div> -->

        <!-- SystemList.blade.phpから送られてきたデータをv-forで展開
             弁をクリックしたら、BaseValve.vueに弁のidと名前と弁番号のデータを送る -->
        <div
            v-for="(Valve, index) in u1_b1"
            :key="Valve.id"
            @click="
                getId(Valve.id),
                    getNumber(Valve.valve_number),
                    getName(Valve.valve_name),
                    getUsuallyState(Valve.valve_usually_state),
                    getIndex(index)
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
        <div v-if="show" @click="show = !show">
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
            ></ValveOption>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        // SystemList.blade.phpから送られてきた、ValveOptionテーブルのデータ
        u1_b1: {
            // type: Object
            default: ""
        }
    },
    data() {
        return {
            // BaseValve.vueに送信する、弁のid(弁をクリック時に送信される)
            sendId: "",
            // BaseValve.vueに送信する、弁の通常状態(弁をクリック時に送信される)
            sendUsuallyState: "",
            // BaseValve.vueに送信する、弁のid(弁をクリック時に送信される)
            sendName: "",
            // BaseValve.vueに送信する、弁の番号(弁をクリック時に送信される)
            sendNumber: "",

            // v-forで展開した各弁にclassを自動で割り振る。// 例: class="b1_3" => 系統図=b1,id=3の弁
            assignClass: "u1_b1_",

            // 弁オプションからemitで飛んできたイベントで用いる。各弁のコンポーネントにpropsで送る。
            // クリックした弁のidがこのdataの中に入っている。
            openCommand: "",
            closeCommand: "",
            adjustedCommand: "",

            // 弁オプション(valveOption)コンポーネントの表示と非表示に使用
            show: false,

            // 上記v-forで展開した弁をクリックした際に、その弁の配列の順番をVuexのstoreへ送る。
            sendIndex: "",

            // propsでBaseValve.vueへ送る。どのstoreへデータを送るか判断する為に使用。
            systemDiagram: "u1_b1"
        };
    },
    // computed: {
    //     watchState:function(){
    //         return this.watchState + 1;
    //     }
    // },
    // watch: {
    //     openCommand: function() {
    //         // watchが変化した際に実行される処理
    //         if (ValveID == this.openCommand) {
    //             this.isActive = false;

    //             let test = this.$refs.test + ValveId
    //             test.backgroundColor = "none"
    //         }
    //     },
    // },
    // b1ページを開いた際にVuexのstoreへ、現状の弁状態のデータ(DBからのデータ)を送る。
    // created() {
    //     this.$store.commit("getData", {
    //         arrayData: this.u1_b1,
    //         systemDiagrams: this.systemDiagram
    //     });
    // },
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
                // index: this.sendIndex,
                // stateInput: stateInput
                id: this.sendId,
                stateInput: stateInput,
            });
        }
    }
};
</script>

<style scoped>
/* 系統線図T-7 */
/* .t-7 {
    
} */

/* 各弁のclass */
.u1_b1_1 {
    position: absolute;
    top: 250px;
    left: 230px;
}
.u1_b1_2 {
    position: absolute;
    top: 250px;
    left: 330px;
}
.u1_b1_3 {
    position: absolute;
    top: 250px;
    left: 430px;
}
.u1_b1_4 {
    position: absolute;
    top: 250px;
    left: 530px;
}
.u1_b1_5 {
    position: absolute;
    top: 250px;
    left: 630px;
}
/* 弁名称の表示関係のcss */
.valve_name {
    margin-top: 20px;
}
</style>
