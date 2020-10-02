<template>
    <div @mousemove.stop>
        <div v-if="tagShow">
            <span>縦</span>
            <button @click="heightUp()">+</button>
            <button @click="heightDown()">-</button>
            <span>横</span>
            <button @click="widthUp()">+</button>
            <button @click="widthDown()">-</button>
            <textarea class="tag_memo" :style="memoStyles"></textarea>
            <button @click="updateTag">保存</button>
        </div>
        <button @click="tagShow = !tagShow">付箋</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            memoStyles: {
                width: 200,
                height: 100
            },
            tagId:1,
            tagContent:"成功",
            tagWidth:300,
            tagheight:300,
            tagShow: false,
            tagShow2: 1,
        };
    },
    methods: {
        updateTag() {
            // タイマーで遅らせる理由
            // propsに弁1番が入っている時に弁2番を操作する→弁2番の操作が弁1番の方に反映されてしまう。
            setTimeout(
                () =>
                    // axiosでデータを送る(このコンポーネント=>app/Http/Request/StoreOption.php=>ValveController=>DB)
                    axios
                        .put("/api/Tag/" + this.tagId, {
                            content: this.tagContent,
                            width: this.tagWidth,
                            height: this.tagHeight,
                            visibility:this.tagShow2
                        })
                        .then(response => {
                            console.log(response);
                        }),
                200
            );
        },
        heightUp: function() {
            if (this.memoStyles.height < 500) {
                this.memoStyles.height += 25;
            }
        },
        heightDown: function() {
            if (this.memoStyles.height > 25) {
                this.memoStyles.height -= 25;
            }
        },
        widthUp: function() {
            if (this.memoStyles.width < 750) {
                this.memoStyles.width += 25;
            }
        },
        widthDown: function() {
            if (this.memoStyles.width > 25) {
                this.memoStyles.width -= 25;
            }
        }
    }
};
</script>

<style></style>
