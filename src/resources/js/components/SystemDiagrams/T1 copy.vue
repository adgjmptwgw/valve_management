<template>
    <div>
        <!-- SystemList.blade.phpから送られてきたデータをv-forで展開
             弁をクリックしたら、UsuallyOpen/Close/adjusted.vueに弁のidと名前と弁番号のデータを送る -->
        <div v-for="Valve in T1" :key="Valve.id">
            <p :class="assignClass + Valve.id">{{ Valve.valve_number }}</p>

            <!-- v-forで展開する際、弁が「開」であれば、「開」表示のコンポーネントを表示する。 -->
            <p :class="assignClass + Valve.id">
                <span v-if="Valve.valve_state === '開'">
                    <UsuallyOpen
                        :option-id="Valve.id"
                        :option-number="Valve.valve_number"
                        :option-name="Valve.valve_name"
                    ></UsuallyOpen>
                </span>
                <span v-else-if="Valve.valve_state === '閉'">
                    <div>
                    <UsuallyClose2
                        :option-id="Valve.id"
                        :option-name="Valve.valve_name"
                        :option-number="Valve.valve_number"
                    ></UsuallyClose2>
                    </div>
                    <div>
                        <ValveOption 
                            :option-id="Valve.id"
                            :option-name="Valve.valve_name"
                            :option-number="Valve.valve_number"
                        ></ValveOption>
                    </div>
                </span>
                <span v-else-if="Valve.valve_state === '調整開'">
                    <UsuallyAdjusted
                        :option-id="Valve.id"
                        :option-name="Valve.valve_name"
                        :option-number="Valve.valve_number"
                    ></UsuallyAdjusted>
                </span>
            </p>
        </div>
        <!-- {{ValveOptions.id}} -->
        {{www}}
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
            assignClass: "t1_" // v-forで展開した各弁にclassを自動で割り振る。
            // 例: class="t1_3" => 系統図=t1,id=3の弁
            ,www:true
            // ValveOptions:[]
        };
    },
    methods: {
        eee(){
            // alert("aaa");
            this.www = false
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
