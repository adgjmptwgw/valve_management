<template>
    <div class="frameHight" :style="memoSize">
        <v-container class="padding_styles">
            <v-card color="yellow lighten-5" elevation="24">
                <div v-if="tagShow">
                    <textarea
                        v-model="memoContent"
                        ref="area"
                        :style="frameStyles"
                        placeholder="memo"
                    >
                    </textarea>
                    <v-divider class="border_margin"></v-divider>
                    <v-row>
                        <v-col>
                            <v-btn
                                @click="
                                    updateTag();
                                    pushSaveButton();
                                "
                                block
                                icon
                                >save</v-btn
                            >
                        </v-col>
                        <v-col>
                            <v-btn
                                @click="
                                    (tagShow = !tagShow)(
                                        (buttonShow = !buttonShow)
                                    )
                                "
                                block
                                icon
                            >
                                <div @click="
                                    updateTag();
                                    pushSaveButton();
                                ">
                                    close
                                </div>
                            </v-btn>
                        </v-col>
                    </v-row>
                </div>
            </v-card>
            <v-btn
                @click="(tagShow = !tagShow)((buttonShow = !buttonShow))"
                v-if="buttonShow"
                fab
                x-large
                color="yellow lighten-5"
                ><v-icon dark>mdi-pencil</v-icon></v-btn
            >
        </v-container>
    </div>
</template>

<script>
export default {
    props: ["tagName", "tagPosi"],
    data() {
        return {
            // メモの白背景の大きさ
            memoSizeStyles: {
                width: 200,
                height: 60
            },
            tagId: 1,
            memoContent: "",
            position_X:"200",
            position_Y:"200",
            tagShow: false,
            buttonShow: true,
            
            // メモフレームの高さのデータ
            frameHeight: "",
        };
    },
    computed: {
        // メモの背景の大きさ(単位としてpxを足す為にcomputedを使用)
        memoSize() {
            return {
                "--tag-width": this.memoSizeStyles.width + "px",
                "--tag-height": this.memoSizeStyles.height + "px"
            };
        },
        // メモフレームの大きさ
        frameStyles() {
            return {
                height: this.frameHeight
            };
        }
    },
    // textareaで改行した事を検知し、resize()関数を実行
    watch: {
        memoContent() {
            this.resize();
        }
    },
    mounted() {
        // メモのフレームのサイズ
        this.resize();

        // Vuexからのメモデータ受け取り＆表示
        // もしt1の系統線図であれば、store.state.storeのTagU1_T1のデータを使う。
        // if (this.tagName == "u1_t1") {
        //     var systemDiagrams = this.$store.state.storeTags;
        // }

        //store.stateの中から、state.tagNameとこのページのtagNameが同じものを探し出して、変数にいれる。
        let getStore = this.$store.state.storeTags[0].find(tagStore => {
            return tagStore.tag_name == this.tagName;
        });
        // propsでU1_T1等々から送られてきたtagName(系統線図名)とstoreのtagNameが同じものだけ、
        // 系統線図ページを開く時にメモの内容と表示・非表示の状態が反映される。

        if (this.tagName == getStore.tag_name) {
            this.memoContent = getStore.content;
            // 付箋の表示・非表示ボタンの状態を変更させる処理
            if (getStore.visibility == 1 || getStore.visibility == "true") {
                this.tagShow = true;
                this.buttonShow = false;
            } else if (
                getStore.visibility == 0 ||
                getStore.visibility == "false"
            ) {
                this.tagShow = false;
                this.buttonShow = true;
            }
        }
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
                            tag_name:this.tagName,
                            content: this.memoContent,
                            position_X: this.tagPosi.x,
                            position_Y: this.tagPosi.y,
                            visibility: this.tagShow
                        })
                        .then(response => {
                            console.log(response);
                        }),
                200
            );
        },
        pushSaveButton: function() {
            setTimeout(
                () =>
                    // Vuexにt1等のタグネームとタグのポジションを送信する。
                    this.$store.commit("changeTagStatus", {
                        tagName: this.tagName,
                        tagContent: this.memoContent,
                        tagPosi: this.tagPosi,
                        tagShow: this.tagShow
                    }),
                200
            );
        },
        // 付箋を改行したら、自動的にtextareaが大きくなる処理
        resize() {
            this.frameHeight = "auto";
            this.$nextTick(() => {
                // scrollHeightはtextareaの行の高さを取得する。なぜかエラーが出る。
                this.frameHeight = this.$refs.area.scrollHeight + "px";
                this.memoSizeStyles.height = this.$refs.area.scrollHeight + 30;
            });
        }
    }
};
</script>

<style scoped>
/* メモの白背景の大きさ */
.frameHight {
    height: var(--tag-height);
}
.border_margin {
    margin: 0;
}
.padding_styles {
    padding: 0;
}
</style>
