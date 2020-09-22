<template>
    <div>
        <!-- SystemList.blade.phpから送られてきたデータをv-forで展開
             弁をクリックしたら、UsuallyOpen/Close/adjusted.vueに弁のidと名前と弁番号のデータを送る -->
        <div
            v-for="(Valve, index) in t2"
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

            <!-- v-forで展開する際、弁が「開」であれば、「開」表示のコンポーネントを表示する。 -->
            <p :class="assignClass + Valve.id" @click="show = !show">
                <span v-if="Valve.valve_state === '開'">
                    <UsuallyOpen
                        :option-id="Valve.id"
                        :option-usually-state="Valve.valve_usually_state"
                        :open-command="openCommand"
                        :close-command="closeCommand"
                        :adjusted-command="adjustedCommand"
                        :system-diagram="systemDiagram"
                    ></UsuallyOpen>
                </span>
                <span v-else-if="Valve.valve_state === '閉'">
                    <UsuallyClose
                        :option-id="Valve.id"
                        :option-usually-state="Valve.valve_usually_state"
                        :open-command="openCommand"
                        :close-command="closeCommand"
                        :adjusted-command="adjustedCommand"
                        :system-diagram="systemDiagram"
                    ></UsuallyClose>
                </span>
                <span v-else-if="Valve.valve_state === '調整開'">
                    <UsuallyAdjusted
                        :option-id="Valve.id"
                        :option-usually-state="Valve.valve_usually_state"
                        :open-command="openCommand"
                        :close-command="closeCommand"
                        :adjusted-command="adjustedCommand"
                        :system-diagram="systemDiagram"
                    ></UsuallyAdjusted>
                </span>
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
        t2: {
            // type: Object
            default: ""
        }
    },
    data() {
        return {
            // UsuallyOpen/Close/adjusted.vueに送信する、弁のid(弁をクリック時に送信される)
            sendId: "",
            // UsuallyOpen/Close/adjusted.vueに送信する、弁の通常状態(弁をクリック時に送信される)
            sendUsuallyState: "",
            // UsuallyOpen/Close/adjusted.vueに送信する、弁のid(弁をクリック時に送信される)
            sendName: "",
            // UsuallyOpen/Close/adjusted.vueに送信する、弁の番号(弁をクリック時に送信される)
            sendNumber: "",

            // v-forで展開した各弁にclassを自動で割り振る。// 例: class="t2_3" => 系統図=t2,id=3の弁
            assignClass: "t2_",

            // 弁オプションからemitで飛んできたイベントで用いる。各弁のコンポーネントにpropsで送る。
            // クリックした弁のidがこのdataの中に入っている。
            openCommand: "",
            closeCommand: "",
            adjustedCommand: "",

            // 弁オプション(valveOption)コンポーネントの表示と非表示に使用
            show: false,

            // 上記v-forで展開した弁をクリックした際に、その弁の配列の順番をVuexのstoreへ送る。
            sendIndex: "",

            // propsでUsuallyOpen/Close/adjustedへ送る。どのstoreへデータを送るか判断する為に使用。
            systemDiagram: "t2"
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
    // t2ページを開いた際にVuexのstoreへ、現状の弁状態のデータ(DBからのデータ)を送る。
    created() {
        this.$store.commit("getData", {
            arrayData: this.t2,
            systemDiagrams: this.systemDiagram
        });
    },
    methods: {
        // SystemList.blade.phpから送られてきたデータがv-forで展開される。v-forで展開された各idとvalve_nameを
        // propsを用いて、UsuallyOpen/Close/Adjusted.Vueにデータを送信する。
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

        // 開閉ボタンを押した際、その弁のidを各UsuallyOpen/Close/Adjusted.Vueに送る。
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
        // UsuallyOpen/Close/Adjusted.Vueのwatch参照。
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
                index: this.sendIndex,
                stateInput: stateInput
            });
        }
    }
};
</script>

<style scoped>
.t2_1 {
    position: absolute;
    top: 250px;
    left: 230px;
}
.t2_2 {
    position: absolute;
    top: 250px;
    left: 330px;
}
.t2_3 {
    position: absolute;
    top: 250px;
    left: 430px;
}
.t2_4 {
    position: absolute;
    top: 250px;
    left: 530px;
}
.t2_5 {
    position: absolute;
    top: 250px;
    left: 630px;
}
.valve_name {
    margin-top: 20px;
}
</style>
