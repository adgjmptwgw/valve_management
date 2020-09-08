import Router from "vue-router";
// import SystemList from "./components/Menus/SystemList.vue";
import SystemDiagram from "./components/SystemDiagram/T1.vue";
import UsuallyClose from "./components/Parts/UsuallyClose.vue";

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
            component: SystemDiagram
        },
        {
            path: "/UsuallyClose",
            name: "閉のバルブ",
            component: UsuallyClose
        }
    ]
});
