<template>
    <div>
        <div v-for="Valve in T1" :key="Valve.id" @click="select(Valve.id)">
            <p>{{ Valve.id }}</p>

            <p>
                <UsuallyClose :option-id="sendId"></UsuallyClose>
            </p>
        </div>
        {{sendId}}

        <!-- <slot></slot> -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            sendId:""
        };
    },
    props: {
        T1: {
            type: Object
        }
    },
    methods: {
        select:function(ValveId){
           return this.sendId=ValveId            
        }
    },
};
</script>

<style></style>
