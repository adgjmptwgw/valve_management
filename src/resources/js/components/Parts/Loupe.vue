<template>
    <div>
        <div
            class="images"
            @dblclick="showZoomArea = !showZoomArea"
            @mousemove="changePreviewArea"
        >
            <!-- 拡大プレビューエリア -->
            <div
                v-if="showZoomArea"
                class="zoom-area active"
                :style="zoomAreaStyle"
            >
                <img :src="imgSrc" :style="zoomImageStyle" />
            </div>
            <div class="slides-container" :style="slidesContainerStyle">
                <!-- @mouseover="showZoomArea = true"
                @mouseleave="showZoomArea = false" -->
                <div class="cell">
                    <div class="m-lens-container">
                        <!-- 基準の画像 -->
                        <img
                            :src="imgSrc"
                            :style="mLensContainerImgStyle"
                            width="1200px"
                            height="848.359px"
                        />
                        <!-- 拡大エリア -->
                        <div
                            v-if="showZoomArea"
                            class="m-lens"
                            :style="lensStyle"
                        ></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["sendSrc"],
    data() {
        return {
            imgSrc: this.sendSrc,
            // ここを変更すれば、画像サイズが変わる。変更した場合、「スケールの設定」も変更する。
            // imgWidth: 2447 / 3,
            // imgHeight: 2481 / 3,
            imgWidth: 4200.05493 / 3,
            imgHeight: 4258.41287 / 3,
            size: null,
            scale: null,
            showZoomArea: false,
            slidesContainerStyle: {
                width: null
            },
            lensStyle: {
                top: null,
                left: null,
                height: null,
                width: null
            },
            // zoomAreaStyle: {
            //     top: null,
            //     left: null
            // },
            zoomImageStyle: {
                width: null,
                marginLeft: null,
                marginTop: null
            },
            mLensContainerImgStyle: {
                maxHeight: null,
                maxWidth: null
            },
            // --------------------------------------------------------------------
            // 動くメモの座標。マウスクリック時にここへ値を代入。
            loupe_posi: {
                x: 0,
                y: 0
            },
            loupePositionStyles: {
                position: "absolute",
                top: "",
                left: ""
            }
            // --------------------------------------------------------------------
        };
    },
    // --------------------------------------------------------------------
    computed: {
        // (dataのloupePositionStylesからの値を取り出し、css変数に値を代入する。)
        zoomAreaStyle() {
            return {
                "--position-top": this.loupePositionStyles.top - 280 + "px",
                "--position-left": this.loupePositionStyles.left - 220 + "px"
            };
        }
    },
    // --------------------------------------------------------------------
    methods: {
        // 拡大プレビューの変更
        changePreviewArea(event) {
            let size = this.size;
            let scale = this.scale;

            // 座標を取得
            let container = document.querySelectorAll(".m-lens-container");
            let rect = container[0].getBoundingClientRect();
            let mouseX = event.pageX;
            let mouseY = event.pageY;

            // スクロール分も計算に入れる
            // コンテナの左上からの距離 = ページの左上からの距離 - スクロール量 - ウィンドウの左上からの距離
            let positionX = rect.left + window.pageXOffset;
            let positionY = rect.top + window.pageYOffset;
            let offsetX = mouseX - positionX;
            let offsetY = mouseY - positionY;
            let left = offsetX - size / 2;
            let top = offsetY - size / 2;

            // 拡大エリアの限界値を設定
            let img = container[0].querySelector("img");
            let xMax = img.offsetWidth - size;
            let yMax = img.offsetHeight - size;
            if (left > xMax) {
                left = xMax;
            }
            if (top > yMax) {
                top = yMax;
            }
            if (left < 0) {
                left = 0;
            }
            if (top < 0) {
                top = 0;
            }

            // 拡大エリアの位置
            this.lensStyle.top = top + "px";
            this.lensStyle.left = left + "px";

            // 拡大エリアのプレビュー表示箇所の変更処理
            this.zoomImageStyle.marginLeft = -(left * scale) + "px";
            this.zoomImageStyle.marginTop = -(top * scale) + "px";
            // --------------------------------------------------------------------
            this.loupe_posi.x = event.screenX;
            this.loupe_posi.y = event.screenY;

            // if (this.loupe_posi.x >= 1220) {
            if (this.loupe_posi.x >= 1270) {
                this.loupe_posi.x = this.loupe_posi.x - 350;
            }
            // if (this.loupe_posi.y >= 680) {
            if (this.loupe_posi.y >= 800) {
                this.loupe_posi.y = this.loupe_posi.y - 350;
            // } else if (this.loupe_posi.y <= 285) {
            } else if (this.loupe_posi.y <= 180) {
                this.loupe_posi.y = this.loupe_posi.y + 350;
            }
            this.loupePositionStyles.left = this.loupe_posi.x;
            this.loupePositionStyles.top = this.loupe_posi.y;
            // --------------------------------------------------------------------
        },

        // styleのプロパティをセット
        setStyleProperty() {
            let width = this.imgWidth;
            let height = this.imgHeight;

            // コンテナのサイズを設定
            this.slidesContainerStyle.width = width;

            // 表示する基準の画像のサイズを設定
            this.mLensContainerImgStyle.maxHeight = height + "px";
            this.mLensContainerImgStyle.maxWidth = width + "px";

            // ズームエリアの位置を設定
            // this.zoomAreaStyle.left = width + 20 + "px";

            // 拡大鏡エリアのサイズを設定
            // 数値を変更することでズームエリアの画像サイズも変更される
            // this.size = width >= height ? width * 0.2 : height * 0.2;
            this.size = width >= height ? width * 0.12 : height * 0.12;
            let size = this.size;
            this.lensStyle.height = size + "px";
            this.lensStyle.width = size + "px";

            // スケールの設定
            // this.scale = 524 / size;
            this.scale = 240 / size;
            let scale = this.scale;

            // ズームエリアに表示する画像のサイズを設定
            this.zoomImageStyle.width = width * scale + "px";
        }
    },
    mounted() {
        this.setStyleProperty();
    }
};
</script>

<style lang="scss" scoped>
// 系統線図の画像
.m-lens-container {
    display: inline-block;
    position: relative;
    top: 0px;
    left: 220px;
}
// オレンジの拡大範囲の表示
.m-lens {
    position: absolute;
    z-index: 0;
    background: #f57716;
    opacity: 0.3;
}
.cell {
    display: table-cell;
    vertical-align: middle; /* 縦に中央揃え */
}
.images {
    position: relative;
}
.slides-container {
    /* カルーセル表示領域 */
    overflow: hidden;
}
// ルーペ部分
.zoom-area {
    display: none;
    position: absolute;
    border: 1px solid #ccc;
    height: 420px;
    width: 420px;
    overflow: hidden;
    z-index: 1;
    // ---------------------------
    top: var(--position-top);
    left: var(--position-left);
    // ---------------------------
}
.zoom-area.active {
    display: block;
}
</style>
