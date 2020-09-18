<template>
    <div>
          <span>
            <img
                :src="'/img/open_valve_2.png'"
                alt="弁「開」"
                class="openV"
                v-if="close"
            />
            <img
                :src="'/img/adjusted_valve_2.png'"
                alt="調整開"
                class="adjustedV"
                v-if="adjusted"
            />
            <img
                :src="'/img/close_valve_2.png'"
                alt="弁「閉」"
                class="closeV"
                v-if="open"
            />
        </span>
    </div>
</template>

<script>
export default {
    data() {
        return {
            open: true,
            close: true,
            adjusted: true,
        };
    },
};
</script>

<style scoped>
/* 通常「閉」のバルブimg */
.closeV {
    width: 20%;
    height: 5%;
    position: absolute;
}

/* 通常「開」のバルブimg */
.openV {
    width: 20%;
    height: 5%;
    position: absolute;
}

/* 「調整開」のバルブimg */
.adjustedV {
    width: 20%;
    height: 5%;
    position: absolute;
}
</style>
