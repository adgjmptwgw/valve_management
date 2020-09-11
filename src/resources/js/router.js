import Router from "vue-router";
// import SystemList from "./components/Menus/SystemList.vue";
import T1 from "./components/SystemDiagrams/T1.vue";
import T2 from "./components/SystemDiagrams/T2.vue";

export default new Router({
    mode: "history",
    routes: [
        // {
        //     path: "/SystemList",
        //     name: "目次",
        //     component: SystemList
        // },
        {
            path: "/T1",
            name: "T-1系統線図",
            component: T1
        },
        {
            path: "/T2",
            name: "T-2系統線図",
            component: T2
        }
    ]
});
