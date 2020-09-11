<template>
    <div>
        {{ T2 }}
    </div>
</template>

<script>
export default {
    data() {
        return {
            sendId: "", // バルブのコンポーネントに送る弁のid(弁をクリック時に送信される)
            roadClose: true
        };
    },
    props: ["T2"],
    // {
    //     type: Oxbject
    // }
    methods: {
        getId: function(ValveId) {
            return (this.sendId = ValveId);
        }
    }
};
</script>
