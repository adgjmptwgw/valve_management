<template>
    <div>
        <div>
            <img
                :src="'/img/open_valve_2.png'"
                alt="弁「開」"
                class="openV"
                v-if="open"
            />
            <img
                :src="'/img/close_valve_2.png'"
                alt="弁「閉」"
                class="closeV"
                v-if="close"
            />
            <img
                :src="'/img/adjusted_valve_2.png'"
                alt="「調整開」"
                class="adjustedV"
                v-if="adjusted"
            />
        </div>
    </div>
</template>

<script>
export default {
    props: {
        optionId: {
            default: ""
        },
        openCommand: {
            default: ""
        },
        closeCommand: {
            default: ""
        },
        adjustedCommand: {
            default: ""
        }
    },
    data() {
        return {
            open: true,
            close: true,
            adjusted: true
        };
    },
    watch: {
        openCommand: function() {
            // watchが変化した際に実行される処理
            if (this.optionId == this.openCommand) {
                this.open = true;
                this.close = false;
                this.adjusted = false;
            }
        },
        closeCommand: function() {
            // watchが変化した際に実行される処理
            if (this.optionId == this.closeCommand) {
                this.open = false;
                this.close = true;
                this.adjusted = false;
            }
        },
        adjustedCommand: function() {
            // watchが変化した際に実行される処理
            if (this.optionId == this.adjustedCommand) {
                this.open = false;
                this.close = false;
                this.adjusted = true;
            }
        }
    }
};
</script>

<style scoped>
/* 通常「閉」のバルブimg */
.closeV {
    width: 25px;
    height: 15px;
    position: absolute;
}

/* 通常「開」のバルブimg */
.openV {
    width: 25px;
    height: 15px;
    position: absolute;
}

/* 「調整開」のバルブimg */
.adjustedV {
    width: 25px;
    height: 15px;
    position: absolute;
}
</style>
