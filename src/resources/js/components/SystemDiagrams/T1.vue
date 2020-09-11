<template>
    <div>
        <div v-for="Valve in T1" :key="Valve.id" @click="getId(Valve.id)">
            <p>{{ Valve.id }}</p>

            <p :class="assignClass + Valve.id">
                <span v-if="Valve.valve_state === '開'">
                    <UsuallyOpen :option-id="sendId"></UsuallyOpen>
                </span>
                <span v-else-if="Valve.valve_state === '閉'">
                    <UsuallyClose :option-id="sendId"></UsuallyClose>
                </span>
                <span v-else-if="Valve.valve_state === '調整開'">
                    <UsuallyAdjusted :option-id="sendId"></UsuallyAdjusted>
                </span>
            </p>
        </div>

        {{ sendId }}  
        <!-- {{ValveOptions.id}} --> 
    </div>
</template>

<script>
// const axios = require('axios');
export default {
    props: {
        T1: {
            type: Object
        }
    },
    data() {
        return {
            sendId: "", // バルブのコンポーネントに送る弁のid(弁をクリック時に送信される)
            assignClass: "t1_",
            // ValveOptions:[]
        };
    },
    methods: {
        getId: function(ValveId) {
            return (this.sendId = ValveId);
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

<style scope>
.t1_2 {
    color: red;
}
</style>
