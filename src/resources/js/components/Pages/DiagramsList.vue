<template>
    <v-app>
        <v-container>
            <div id="app" class="test">
                <div class="boiler_list_title">
                    <img src="/img/Parts/boiler_img.png" alt="ボイラ" class="boiler_img">
                    <h1>1号 ボイラ</h1>
                </div>
                <v-row>
                    <v-col>
                        <v-col>
                            <router-link to="/u1_b4">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="red lighten-5"
                                    >
                                        B-4
                                    </v-btn>
                                    <h3>ボイラ廻り系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_b5">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="red lighten-5"
                                    >
                                        B-5
                                    </v-btn>
                                    <h3>缶水循環ポンプ廻り系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_b9">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="red lighten-5"
                                    >
                                        B-9
                                    </v-btn>
                                    <h3>スートブロワ系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_b11">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="red lighten-5"
                                    >
                                        B-11
                                    </v-btn>
                                    <h3>補助蒸気系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_b17">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="red lighten-5"
                                    >
                                        B-17
                                    </v-btn>
                                    <h3>1号機ミルイナートシステム系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_b18">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="red lighten-5"
                                    >
                                        B-18
                                    </v-btn>
                                    <h3>重油タンク廻り系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_b19">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="red lighten-5"
                                    >
                                        B-19
                                    </v-btn>
                                    <h3>重油燃焼装置系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                    </v-col>
                    <v-col>
                        <v-col>
                            <router-link to="/u1_b20">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="red lighten-5"
                                    >
                                        B-20
                                    </v-btn>
                                    <h3>重油スチームトレース系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_b21">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="red lighten-5"
                                    >
                                        B-21
                                    </v-btn>
                                    <h3>重油ポンプ室トレース蒸気系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_b23">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="red lighten-5"
                                    >
                                        B-23
                                    </v-btn>
                                    <h3>薬注サンプリング系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_b24">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="red lighten-5"
                                    >
                                        B-24
                                    </v-btn>
                                    <h3>
                                        タンクヤード廻り及び<br />
                                        泡消化装置系統図
                                    </h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_b27">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="red lighten-5"
                                    >
                                        B-27
                                    </v-btn>
                                    <h3>
                                        制御用空気圧縮機及び <br />
                                        制御用空気除湿器系統図
                                    </h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_b30">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="red lighten-5"
                                    >
                                        B-30
                                    </v-btn>
                                    <h3>A・B-雑用空気圧縮機系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_b31">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="red lighten-5"
                                    >
                                        B-31
                                    </v-btn>
                                    <h3>C-雑用空気圧縮機系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                    </v-col>
                    <v-col>
                        <v-col>
                            <router-link to="/u1_b34">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="red lighten-5"
                                    >
                                        B-34
                                    </v-btn>
                                    <h3>1号サンプリング装置系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_b36">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="red lighten-5"
                                    >
                                        B-36
                                    </v-btn>
                                    <h3>点火トーチ系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_b37">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="red lighten-5"
                                    >
                                        B-37
                                    </v-btn>
                                    <h3>
                                        1号重油バーナ系統図 <br />
                                        (1〜4コーナー)
                                    </h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_b38">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="red lighten-5"
                                    >
                                        B-38
                                    </v-btn>
                                    <h3>
                                        1号重油バーナ系統図 <br />
                                        (5〜8コーナー)
                                    </h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_b41">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="red lighten-5"
                                    >
                                        B-41
                                    </v-btn>
                                    <h3>所内ボイラ系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                    </v-col>
                </v-row>
                <v-divider></v-divider>
                <div class="boiler_list_title">
                    <img src="/img/Parts/turbine_img.png" alt="タービン" class="turbine_img">
                    <h1>1号 タービン</h1>
                </div>
                <v-row>
                    <v-col>
                        <v-col>
                            <router-link to="/u1_t3">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="blue lighten-5"
                                    >
                                        B-3
                                    </v-btn>
                                    <h3>
                                        タービン本体・BFP-Tグランド漏洩 <br />
                                        及びエゼクタ蒸気系統図
                                    </h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_t4">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="blue lighten-5"
                                    >
                                        B-4
                                    </v-btn>
                                    <h3>タービン廻りドレン系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_t5">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="blue lighten-5"
                                    >
                                        T-5
                                    </v-btn>
                                    <h3>タービン関係 <br>
                                        ドレンベント系統図(1/2)</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_t6">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="blue lighten-5"
                                    >
                                        T-6
                                    </v-btn>
                                    <h3>タービン関係 <br>
                                        ドレンベント系統図(1/2)</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_t7">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="blue lighten-5"
                                    >
                                        T-7
                                    </v-btn>
                                    <h3>復水低圧給水加熱器系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_t8">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="blue lighten-5"
                                    >
                                        T-8
                                    </v-btn>
                                    <h3>復水系統図(1/2)</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_t9">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="blue lighten-5"
                                    >
                                        T-9
                                    </v-btn>
                                    <h3>復水系統図(2/2)</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_t10">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="blue lighten-5"
                                    >
                                        T-10
                                    </v-btn>
                                    <h3>復水器検塩装置系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                    </v-col>
                    <v-col>
                        <v-col>
                            <router-link to="/u1_t11">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="blue lighten-5"
                                    >
                                        B-11
                                    </v-btn>
                                    <h3>給水ポンプ廻り管系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_t12">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="blue lighten-5"
                                    >
                                        B-12
                                    </v-btn>
                                    <h3>高圧ヒータ廻り系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_t13">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="blue lighten-5"
                                    >
                                        T-13
                                    </v-btn>
                                    <h3>主タービン油清浄器系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_t16">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="blue lighten-5"
                                    >
                                        T-16
                                    </v-btn>
                                    <h3>BFP-T油清浄器系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_t19">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="blue lighten-5"
                                    >
                                        T-19
                                    </v-btn>
                                    <h3>原水消化水配管系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_t20">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="blue lighten-5"
                                    >
                                        T-20
                                    </v-btn>
                                    <h3>本館原水系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_t25">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="blue lighten-5"
                                    >
                                        T-25
                                    </v-btn>
                                    <h3>補給水系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_t26">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="blue lighten-5"
                                    >
                                        T-26
                                    </v-btn>
                                    <h3>ボイラ冷却水系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                    </v-col>
                    <v-col>
                        <v-col>
                            <router-link to="/u1_t28">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="blue lighten-5"
                                    >
                                        B-28
                                    </v-btn>
                                    <h3>タービン冷却水系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_t30">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="blue lighten-5"
                                    >
                                        B-30
                                    </v-btn>
                                    <h3>海水系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_t31">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="blue lighten-5"
                                    >
                                        T-31
                                    </v-btn>
                                    <h3>海水電解装置配管系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_t32">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="blue lighten-5"
                                    >
                                        T-32
                                    </v-btn>
                                    <h3>取水口洗浄水系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_t33">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="blue lighten-5"
                                    >
                                        T-33
                                    </v-btn>
                                    <h3>硫酸第一鉄注入装置系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_t36">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="blue lighten-5"
                                    >
                                        T-36
                                    </v-btn>
                                    <h3>
                                        主タービンNo.1,2油止輪<br />
                                        シールエアー系統図
                                    </h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                    </v-col>
                </v-row>
                <v-divider></v-divider>
                <div class="boiler_list_title">
                    <img src="/img/Parts/generator_img.png" alt="電気" class="generator_img">
                    <h1>1号 電気</h1>
                </div>
                <v-row>
                    <v-col>
                        <v-col>
                            <router-link to="/u1_e26">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="yellow lighten-5"
                                    >
                                        E-26
                                    </v-btn>
                                    <h3>発電機油管系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_e26">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="yellow lighten-5"
                                    >
                                        E-29
                                    </v-btn>
                                    <h3>発電機ガス系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                    </v-col>
                    <v-col>
                        <v-col>
                            <router-link to="/u1_e30">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="yellow lighten-5"
                                    >
                                        E-30
                                    </v-btn>
                                    <h3>窒素ガス系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                        <v-col>
                            <router-link to="/u1_e31">
                                <v-row>
                                    <v-btn
                                        class="list_btn font-weight-bold"
                                        color="yellow lighten-5"
                                    >
                                        E-31
                                    </v-btn>
                                    <h3>予備用電源装置配管系統図</h3>
                                </v-row>
                            </router-link>

                            <div>
                                <router-view />
                            </div>
                        </v-col>
                    </v-col>
                    <v-col></v-col>
                </v-row>
            </div>
        </v-container>
    </v-app>
</template>

<script>
export default {
    props: [
        // 1号ボイラ
        "u1_b4",
        "u1_b5",
        "u1_b9",
        "u1_b11",
        "u1_b16",
        "u1_b17",
        "u1_b18",
        "u1_b19",
        "u1_b20",
        "u1_b21",
        "u1_b23",
        "u1_b24",
        "u1_b27",
        "u1_b30",
        "u1_b31",
        "u1_b34",
        "u1_b35",
        "u1_b36",
        "u1_b37",
        "u1_b38",
        "u1_b39",
        "u1_b40",
        "u1_b41",
        // 1号タービン
        "u1_t3",
        "u1_t4",
        "u1_t5",
        "u1_t6",
        "u1_t7",
        "u1_t8",
        "u1_t9",
        "u1_t10",
        "u1_t11",
        "u1_t12",
        "u1_t13",
        "u1_t16",
        "u1_t19",
        "u1_t20",
        "u1_t25",
        "u1_t26",
        "u1_t28",
        "u1_t30",
        "u1_t31",
        "u1_t32",
        "u1_t33",
        "u1_t36",
        // 1号電気
        "u1_e27",
        "u1_e29",
        "u1_e30",
        "u1_e31",
        // タグデータ
        "tags"
    ],
    created() {
        // 目次ページを開いた時にVuexのmutationsを用いて、stateへデータを送る。
        this.$store.commit("getDataValves", {
            arrayData: [this.u1_b4, this.u1_b5, this.u1_t3, this.u1_t4],
            tagsData: this.tags
        });
        // this.$store.commit("getDataTags", this.tags);
        // this.$store.commit("getDataTags", {
        //     tagsData: [this.tags]
        // });
    },
    methods: {
        // addButton() {
        //     function getNewNote() {
        //         return '<div class="note">' + '<input type="text">' + "</div>";
        //     }
        //     var note = getNewNote();
        //     $("#sticky-note-container").append(note);
        // }
    }
};
</script>

<style scoped>
.boiler_list_title,.turbine_list_title,.generator_list_title {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 50px;
}
.boiler_img,.turbine_img,.generator_img{
    width: 100px;
    height: 100px;
}
h1{
    margin-left: 40px;
}
h3 {
    font-size: 100%;
    margin: auto auto auto 30px;
}
a {
    text-decoration: none;
    transition: .2s;
}
a:link {
  color: black;
}
a:visited {
  color: black;
}
a:hover {
  color: red;
  font-size: 117%;
}
</style>
