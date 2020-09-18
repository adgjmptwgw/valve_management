<template>
    <div>
        <!-- SystemList.blade.phpから送られてきたデータをv-forで展開
             弁をクリックしたら、UsuallyOpen/Close/adjusted.vueに弁のidと名前と弁番号のデータを送る -->
        <div
            v-for="Valve in T1"
            :key="Valve.id"
            @click="
                getId(Valve.id),
                    getNumber(Valve.valve_number, getName(Valve.valve_name))
            "
        >
            <p :class="assignClass + Valve.id">{{ Valve.valve_number }}</p>

            <!-- v-forで展開する際、弁が「開」であれば、「開」表示のコンポーネントを表示する。 -->
            <p :class="assignClass + Valve.id" @click="show = !show">
                <span v-if="Valve.valve_state === '開'">
                    <UsuallyOpen
                        :option-id="Valve.id"
                        :option-number="Valve.valve_number"
                        :option-name="Valve.valve_name"
                        :open-command="openCommand"
                        :close-command="closeCommand"
                        :adjusted-command="adjustedCommand"
                    ></UsuallyOpen>
                </span>
                <span v-else-if="Valve.valve_state === '閉'">
                    <!-- <img
                        :src="url"
                        alt="弁「閉」"
                        class="closeV"
                    /> -->
                    <div>
                        <UsuallyClose
                            :option-id="Valve.id"
                            :option-name="Valve.valve_name"
                            :option-number="Valve.valve_number"
                            :open-command="openCommand"
                            :close-command="closeCommand"
                            :adjusted-command="adjustedCommand"
                        ></UsuallyClose>
                    </div>
                    <!-- <div>
                        <ValveOption
                            :option-id="Valve.id"
                            :option-name="Valve.valve_name"
                            :option-number="Valve.valve_number"
                        ></ValveOption>
                    </div> -->
                </span>
                <span v-else-if="Valve.valve_state === '調整開'">
                    <UsuallyAdjusted
                        :option-id="Valve.id"
                        :option-name="Valve.valve_name"
                        :option-number="Valve.valve_number"
                        :open-command="openCommand"
                        :close-command="closeCommand"
                        :adjusted-command="adjustedCommand"
                    ></UsuallyAdjusted>
                </span>
            </p>
        </div>

        <div v-if="show" @click="show = !show">
        <ValveOption
            :option-id="sendId"
            :option-name="sendName"
            :option-number="sendNumber"
            @push-open="pushOpen"
            @push-close="pushClose"
            @push-adjusted="pushAdjusted"
            @push-reset-open="pushResetOpen"
            @push-reset-close="pushResetClose"
            @push-reset-adjusted="pushResetAdjusted"
        ></ValveOption>
        </div>

        <!-- {{ValveOptions.id}} -->
    </div>
</template>

<script>
// import UsuallyCloseVue from "../Parts/UsuallyClose.vue";
// const axios = require('axios');
export default {
    props: {
        // SystemList.blade.phpから送られてきた、ValveOptionテーブルのデータ
        T1: {
            type: Object
        }
    },
    data() {
        return {
            sendId: "",
            // UsuallyOpen/Close/adjusted.vueに送信する、弁のid(弁をクリック時に送信される)
            sendName: "",
            // UsuallyOpen/Close/adjusted.vueに送信する、弁のid(弁をクリック時に送信される)
            sendNumber: "",
            // UsuallyOpen/Close/adjusted.vueに送信する、弁の番号(弁をクリック時に送信される)
            assignClass: "t1_", // v-forで展開した各弁にclassを自動で割り振る。
            // 例: class="t1_3" => 系統図=t1,id=3の弁

            // ValveOptions:[]

            // 弁オプションからemitで飛んできたイベントで用いる。各弁のコンポーネントにpropsで送る。
            openCommand: "",
            closeCommand: "",
            adjustedCommand: "",

            show:false
        };
    },
    // computed: {
    //     count(){
    //         return this.$store.state.count;
    //     }
    // },
    methods: {
        // SystemList.blade.phpから送られてきたデータがv-forで展開される。v-forで展開された各idとvalve_nameを
        // propsを用いて、UsuallyOpen/Close/Adjusted.Vueにデータを送信する。
        getId: function(ValveId) {
            return (this.sendId = ValveId);
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
        }
    }

    // mounted() {
    //     axios.get('/SystemList/json')
    //          .then(response =>{
    //              this.ValveOptions = response.data;
    //          })
    // },
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
</style>
