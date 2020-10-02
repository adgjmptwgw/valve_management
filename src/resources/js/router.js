import Router from "vue-router";
import SystemList from "./components/Menus/SystemList.vue";
// import SystemList2 from "./components/Menus/SystemList2.vue";
import U1_T1 from "./components/SystemDiagrams/U1_T1.vue";
import U1_T2 from "./components/SystemDiagrams/U1_T2.vue";
import U1_B1 from "./components/SystemDiagrams/U1_B1.vue";

export default new Router({
    mode: "history",
    routes: [
        {
            path: "/SystemList",
            name: "目次",
            component: SystemList
        },
        // {
        //     path: "/SystemList2",
        //     name: "目次",
        //     component: SystemList2
        // },
        {
            path: "/U1_T1",
            name: "T-1系統線図",
            component: U1_T1
        },
        {
            path: "/U1_T2",
            name: "T-2系統線図",
            component: U1_T2
        },
        {
            path: "/U1_B1",
            name: "B-1系統線図",
            component: U1_B1
        }
    ]
});
