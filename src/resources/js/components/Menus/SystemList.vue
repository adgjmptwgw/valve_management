<template>
    <v-app>
        <!-- <v-content> -->
            <div id="app" class="test">
                <div>
                    <router-link to="/u1_t1">T-1</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t2">T-2</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t3">t-3</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t4">t-4</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t5">t-5</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t6">t-6</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t2">t-2</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t7">t-7</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t8">t-8</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t9">t-9</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t10">t-10</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t11">t-11</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t12">t-12</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t13">t-13</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t14">t-14</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t15">t-15</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t16">t-16</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t17">t-17</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t18">t-18</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t19">t-19</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t20">t-20</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t21">t-21</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t22">t-22</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t23">t-23</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t24">t-24</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t25">t-25</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t26">t-26</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t27">t-27</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t28">t-28</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t29">t-29</router-link>
                </div>

                <div>
                    <router-view />
                </div>
                <div>
                    <router-link to="/u1_t30">t-30</router-link>
                </div>

                <div>
                    <router-view />
                </div>

                <div>
                    <router-link to="/u1_b1">B-1</router-link>
                </div>

                <div>
                    <router-view />
                </div>
            </div>
        <!-- </v-content> -->
    </v-app>
</template>

<script>
export default {
    props: {
        u1_t1: {
            default: ""
        },
        u1_t2: {
            default: ""
        },
        u1_b1: {
            default: ""
        }
    },
    data() {
        return {};
    },
    created() {
        // 目次ページを開いた時にVuexのmutationsを用いて、stateへデータを送る。
        this.$store.commit("getData", {
            arrayData: [this.u1_t1, this.u1_t2, this.u1_b1]
        });
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

<style>
/* .test{
    margin: 0px auto;
} */

.note {
    background-color: aliceblue;
    padding: 10px;
}
.note > input[type="text"] {
    width: 90%;
    height: 5rem;
}
</style>
