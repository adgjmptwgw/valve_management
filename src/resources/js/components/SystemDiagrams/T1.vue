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
            <p :class="assignClass + Valve.id">
                <!-- {{Valve.valve_state}} -->
                <span v-if="Valve.valve_state === '開'">
                    <UsuallyOpen
                        :option-id="sendId"
                        :option-number="sendNumber"
                        :option-name="sendName"
                    ></UsuallyOpen>
                </span>
                <span v-else-if="Valve.valve_state === '閉'">
                    <UsuallyClose
                        :option-id="sendId"
                        :option-name="sendName"
                        :option-number="sendNumber"
                        @HogeEmit="hogeAction"
                    >
                    </UsuallyClose>
                    <img :src="test" alt="" />
                </span>
                <span v-else-if="Valve.valve_state === '調整開'">
                    <UsuallyAdjusted
                        :option-id="sendId"
                        :option-name="sendName"
                        :option-number="sendNumber"
                    ></UsuallyAdjusted>
                </span>
            </p>
        </div>


        <!-- {{ sendId }}
        {{ sendName }} -->
        <!-- {{ test }} -->
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
            sendId: "", // UsuallyOpen/Close/adjusted.vueに送信する、弁のid(弁をクリック時に送信される)
            sendName: "", // UsuallyOpen/Close/adjusted.vueに送信する、弁のid(弁をクリック時に送信される)
            sendNumber: "", // UsuallyOpen/Close/adjusted.vueに送信する、弁の番号(弁をクリック時に送信される)
            assignClass: "t1_", // v-forで展開した各弁にclassを自動で割り振る。
            // 例: class="t1_3" => 系統図=t1,id=3の弁
            // ValveOptions:[]
            test: "/img/open_valve_2.png",
        };
    },
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
        hogeAction() {
            return (this.test = "/img/close_valve_2.png");
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
.t1_3 {
    color: red;
    position: absolute;
    top:100px;
    right: 100px;
}
</style>
