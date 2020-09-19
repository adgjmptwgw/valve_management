<template>
    <div>
        <!-- SystemList.blade.phpから送られてきたデータをv-forで展開
             弁をクリックしたら、UsuallyOpen/Close/adjusted.vueに弁のidと名前と弁番号のデータを送る -->
        <div
            v-for="Valve in t1"
            :key="Valve.id"
            @click="
                getId(Valve.id),
                    getNumber(Valve.valve_number),
                    getName(Valve.valve_name),
                    getUsuallyState(Valve.valve_usually_state)
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
                    ></UsuallyOpen>
                </span>
                <span v-else-if="Valve.valve_state === '閉'">
                    <div>
                        <UsuallyClose
                            :option-id="Valve.id"
                            :option-usually-state="Valve.valve_usually_state"
                            :open-command="openCommand"
                            :close-command="closeCommand"
                            :adjusted-command="adjustedCommand"
                        ></UsuallyClose>
                    </div>
                </span>
                <span v-else-if="Valve.valve_state === '調整開'">
                    <UsuallyAdjusted
                        :option-id="Valve.id"
                        :option-usually-state="Valve.valve_usually_state"
                        :open-command="openCommand"
                        :close-command="closeCommand"
                        :adjusted-command="adjustedCommand"
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
            ></ValveOption>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        // SystemList.blade.phpから送られてきた、ValveOptionテーブルのデータ
        t1: {
            // type: Object
            default:""
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

            // v-forで展開した各弁にclassを自動で割り振る。// 例: class="t1_3" => 系統図=t1,id=3の弁
            assignClass: "t1_",

            // 弁オプションからemitで飛んできたイベントで用いる。各弁のコンポーネントにpropsで送る。
            // クリックした弁のidがこのdataの中に入っている。
            openCommand: "",
            closeCommand: "",
            adjustedCommand: "",

            // 弁オプション(valveOption)コンポーネントの表示と非表示に使用
            show: false
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
        pushOpen: function() {
            return (this.openCommand = this.sendId);
        },
        pushClose: function() {
            return (this.closeCommand = this.sendId);
        },
        pushAdjusted: function() {
            return (this.adjustedCommand = this.sendId);
        },
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
        // refTest(){
        //     let test = this.$refs.test;
        //     test.style.display = "none";
        // }
    }
};
</script>

<style scoped>
.t1_1 {
    position: absolute;
    top: 250px;
    left: 230px;
}
.t1_2 {
    position: absolute;
    top: 250px;
    left: 330px;
}
.t1_3 {
    position: absolute;
    top: 250px;
    left: 430px;
}
.t1_4 {
    position: absolute;
    top: 250px;
    left: 530px;
}
.t1_5 {
    position: absolute;
    top: 250px;
    left: 630px;
}
.valve_name {
    margin-top: 20px;
}
</style>
