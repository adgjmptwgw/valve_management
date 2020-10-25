import Router from "vue-router";
// 1号機目次
import DiagramsList from "./components/Pages/DiagramsList.vue";

// 1号ボイラ系統線図
import U1_B4 from "./components/SystemDiagrams/boiler/U1_B4.vue";
import U1_B5 from "./components/SystemDiagrams/boiler/U1_B5.vue";
import U1_B9 from "./components/SystemDiagrams/boiler/U1_B9.vue";
import U1_B11 from "./components/SystemDiagrams/boiler/U1_B11.vue";
import U1_B17 from "./components/SystemDiagrams/boiler/U1_B17.vue";
import U1_B18 from "./components/SystemDiagrams/boiler/U1_B18.vue";
import U1_B19 from "./components/SystemDiagrams/boiler/U1_B19.vue";
import U1_B20 from "./components/SystemDiagrams/boiler/U1_B20.vue";
import U1_B21 from "./components/SystemDiagrams/boiler/U1_B21.vue";
import U1_B23 from "./components/SystemDiagrams/boiler/U1_B23.vue";
import U1_B24 from "./components/SystemDiagrams/boiler/U1_B24.vue";
import U1_B27 from "./components/SystemDiagrams/boiler/U1_B27.vue";
import U1_B30 from "./components/SystemDiagrams/boiler/U1_B30.vue";
import U1_B31 from "./components/SystemDiagrams/boiler/U1_B31.vue";
import U1_B34 from "./components/SystemDiagrams/boiler/U1_B34.vue";
import U1_B36 from "./components/SystemDiagrams/boiler/U1_B36.vue";
import U1_B37 from "./components/SystemDiagrams/boiler/U1_B37.vue";
import U1_B38 from "./components/SystemDiagrams/boiler/U1_B38.vue";
import U1_B41 from "./components/SystemDiagrams/boiler/U1_B41.vue";

// 2号ボイラ系統線図
import U2_B4 from "./components/SystemDiagrams/boiler/U2_B4.vue";
import U2_B5 from "./components/SystemDiagrams/boiler/U2_B5.vue";
import U2_B6 from "./components/SystemDiagrams/boiler/U2_B6.vue";
import U2_B8 from "./components/SystemDiagrams/boiler/U2_B8.vue";
import U2_B9 from "./components/SystemDiagrams/boiler/U2_B9.vue";
import U2_B11 from "./components/SystemDiagrams/boiler/U2_B11.vue";
import U2_B16 from "./components/SystemDiagrams/boiler/U2_B16.vue";
import U2_B17 from "./components/SystemDiagrams/boiler/U2_B17.vue";
import U2_B18 from "./components/SystemDiagrams/boiler/U2_B18.vue";
import U2_B19 from "./components/SystemDiagrams/boiler/U2_B19.vue";
import U2_B20 from "./components/SystemDiagrams/boiler/U2_B20.vue";
import U2_B21 from "./components/SystemDiagrams/boiler/U2_B21.vue";
import U2_B23 from "./components/SystemDiagrams/boiler/U2_B23.vue";
import U2_B24 from "./components/SystemDiagrams/boiler/U2_B24.vue";
import U2_B27 from "./components/SystemDiagrams/boiler/U2_B27.vue";
import U2_B30 from "./components/SystemDiagrams/boiler/U2_B30.vue";
import U2_B31 from "./components/SystemDiagrams/boiler/U2_B31.vue";
import U2_B34 from "./components/SystemDiagrams/boiler/U2_B34.vue";
import U2_B35 from "./components/SystemDiagrams/boiler/U2_B35.vue";
import U2_B36 from "./components/SystemDiagrams/boiler/U2_B36.vue";
import U2_B37 from "./components/SystemDiagrams/boiler/U2_B37.vue";
import U2_B38 from "./components/SystemDiagrams/boiler/U2_B38.vue";
import U2_B39 from "./components/SystemDiagrams/boiler/U2_B39.vue";
import U2_B40 from "./components/SystemDiagrams/boiler/U2_B40.vue";
import U2_B41 from "./components/SystemDiagrams/boiler/U2_B41.vue";

// 1号タービン系統線図
import U1_T3 from "./components/SystemDiagrams/turbine/U1_T3.vue";
import U1_T4 from "./components/SystemDiagrams/turbine/U1_T4.vue";
import U1_T5 from "./components/SystemDiagrams/turbine/U1_T5.vue";
import U1_T6 from "./components/SystemDiagrams/turbine/U1_T6.vue";
import U1_T7 from "./components/SystemDiagrams/turbine/U1_T7.vue";
import U1_T8 from "./components/SystemDiagrams/turbine/U1_T8.vue";
import U1_T9 from "./components/SystemDiagrams/turbine/U1_T9.vue";
import U1_T10 from "./components/SystemDiagrams/turbine/U1_T10.vue";
import U1_T11 from "./components/SystemDiagrams/turbine/U1_T11.vue";
import U1_T12 from "./components/SystemDiagrams/turbine/U1_T12.vue";
import U1_T13 from "./components/SystemDiagrams/turbine/U1_T13.vue";
import U1_T16 from "./components/SystemDiagrams/turbine/U1_T16.vue";
import U1_T19 from "./components/SystemDiagrams/turbine/U1_T19.vue";
import U1_T20 from "./components/SystemDiagrams/turbine/U1_T20.vue";
import U1_T25 from "./components/SystemDiagrams/turbine/U1_T25.vue";
import U1_T26 from "./components/SystemDiagrams/turbine/U1_T26.vue";
import U1_T28 from "./components/SystemDiagrams/turbine/U1_T28.vue";
import U1_T30 from "./components/SystemDiagrams/turbine/U1_T30.vue";
import U1_T31 from "./components/SystemDiagrams/turbine/U1_T31.vue";
import U1_T32 from "./components/SystemDiagrams/turbine/U1_T32.vue";
import U1_T33 from "./components/SystemDiagrams/turbine/U1_T33.vue";
import U1_T36 from "./components/SystemDiagrams/turbine/U1_T36.vue";

// 2号タービン系統線図
import U2_T1 from "./components/SystemDiagrams/turbine/U2_T1.vue";
import U2_T2 from "./components/SystemDiagrams/turbine/U2_T2.vue";
import U2_T3 from "./components/SystemDiagrams/turbine/U2_T3.vue";
import U2_T4 from "./components/SystemDiagrams/turbine/U2_T4.vue";
import U2_T5 from "./components/SystemDiagrams/turbine/U2_T5.vue";
import U2_T6 from "./components/SystemDiagrams/turbine/U2_T6.vue";
import U2_T7 from "./components/SystemDiagrams/turbine/U2_T7.vue";
import U2_T8 from "./components/SystemDiagrams/turbine/U2_T8.vue";
import U2_T9 from "./components/SystemDiagrams/turbine/U2_T9.vue";
import U2_T10 from "./components/SystemDiagrams/turbine/U2_T10.vue";
import U2_T11 from "./components/SystemDiagrams/turbine/U2_T11.vue";
import U2_T12 from "./components/SystemDiagrams/turbine/U2_T12.vue";
import U2_T13 from "./components/SystemDiagrams/turbine/U2_T13.vue";
import U2_T16 from "./components/SystemDiagrams/turbine/U2_T16.vue";
import U2_T19 from "./components/SystemDiagrams/turbine/U2_T19.vue";
import U2_T20 from "./components/SystemDiagrams/turbine/U2_T20.vue";
import U2_T25 from "./components/SystemDiagrams/turbine/U2_T25.vue";
import U2_T26 from "./components/SystemDiagrams/turbine/U2_T26.vue";
import U2_T28 from "./components/SystemDiagrams/turbine/U2_T28.vue";
import U2_T30 from "./components/SystemDiagrams/turbine/U2_T30.vue";
import U2_T31 from "./components/SystemDiagrams/turbine/U2_T31.vue";
import U2_T32 from "./components/SystemDiagrams/turbine/U2_T32.vue";
import U2_T33 from "./components/SystemDiagrams/turbine/U2_T33.vue";
import U2_T36 from "./components/SystemDiagrams/turbine/U2_T36.vue";

// 1号電気系統線図
import U1_E27 from "./components/SystemDiagrams/electricity/U1_E27.vue";
import U1_E29 from "./components/SystemDiagrams/electricity/U1_E29.vue";
import U1_E30 from "./components/SystemDiagrams/electricity/U1_E30.vue";
import U1_E31 from "./components/SystemDiagrams/electricity/U1_E31.vue";

// 2号電気系統線図
import U2_E28 from "./components/SystemDiagrams/electricity/U2_E28.vue";
import U2_E29 from "./components/SystemDiagrams/electricity/U2_E29.vue";
import U2_E30 from "./components/SystemDiagrams/electricity/U2_E30.vue";
import U2_E31 from "./components/SystemDiagrams/electricity/U2_E31.vue";

export default new Router({
    mode: "history",
    routes: [
        // 1号機目次
        {
            path: "/DiagramsList",
            name: "目次",
            component: DiagramsList
        },

        // ------------------------- 1号ボイラ  -------------------------
        {
            path: "/U1_B4",
            name: "1号B-4系統線図",
            component: U1_B4
        },
        {
            path: "/U1_B5",
            name: "1号B-5系統線図",
            component: U1_B5
        },
        {
            path: "/U1_B9",
            name: "1号B-9系統線図",
            component: U1_B9
        },
        {
            path: "/U1_B11",
            name: "1号B-11系統線図",
            component: U1_B11
        },
        {
            path: "/U1_B17",
            name: "1号B-17系統線図",
            component: U1_B17
        },
        {
            path: "/U1_B18",
            name: "1号B-18系統線図",
            component: U1_B18
        },
        {
            path: "/U1_B19",
            name: "1号B-19系統線図",
            component: U1_B19
        },
        {
            path: "/U1_B20",
            name: "1号B-20系統線図",
            component: U1_B20
        },
        {
            path: "/U1_B21",
            name: "1号B-21系統線図",
            component: U1_B21
        },
        {
            path: "/U1_B23",
            name: "1号B-23系統線図",
            component: U1_B23
        },
        {
            path: "/U1_B24",
            name: "1号B-24系統線図",
            component: U1_B24
        },
        {
            path: "/U1_B27",
            name: "1号B-27系統線図",
            component: U1_B27
        },
        {
            path: "/U1_B30",
            name: "1号B-30系統線図",
            component: U1_B30
        },
        {
            path: "/U1_B31",
            name: "1号B-31系統線図",
            component: U1_B31
        },
        {
            path: "/U1_B34",
            name: "1号B-34系統線図",
            component: U1_B34
        },
        {
            path: "/U1_B36",
            name: "1号B-36系統線図",
            component: U1_B36
        },
        {
            path: "/U1_B37",
            name: "1号B-37系統線図",
            component: U1_B37
        },
        {
            path: "/U1_B38",
            name: "1号B-38系統線図",
            component: U1_B38
        },
        {
            path: "/U1_B41",
            name: "1号B-41系統線図",
            component: U1_B41
        },
        // ------------------------- 2号ボイラ  -------------------------
        {
            path: "/U2_B4",
            name: "2号B-4系統線図",
            component: U2_B4
        },
        {
            path: "/U2_B5",
            name: "2号B-5系統線図",
            component: U2_B5
        },
        {
            path: "/U2_B6",
            name: "2号B-6系統線図",
            component: U2_B6
        },
        {
            path: "/U2_B8",
            name: "2号B-8系統線図",
            component: U2_B8
        },
        {
            path: "/U2_B9",
            name: "2号B-9系統線図",
            component: U2_B9
        },
        {
            path: "/U2_B11",
            name: "2号B-11系統線図",
            component: U2_B11
        },
        {
            path: "/U2_B16",
            name: "2号B-16系統線図",
            component: U2_B16
        },
        {
            path: "/U2_B17",
            name: "2号B-17系統線図",
            component: U2_B17
        },
        {
            path: "/U2_B18",
            name: "2号B-18系統線図",
            component: U2_B18
        },
        {
            path: "/U2_B19",
            name: "2号B-19系統線図",
            component: U2_B19
        },
        {
            path: "/U2_B20",
            name: "2号B-20系統線図",
            component: U2_B20
        },
        {
            path: "/U2_B21",
            name: "2号B-21系統線図",
            component: U2_B21
        },
        {
            path: "/U2_B23",
            name: "2号B-23系統線図",
            component: U2_B23
        },
        {
            path: "/U2_B24",
            name: "2号B-24系統線図",
            component: U2_B24
        },
        {
            path: "/U2_B27",
            name: "2号B-27系統線図",
            component: U2_B27
        },
        {
            path: "/U2_B30",
            name: "2号B-30系統線図",
            component: U2_B30
        },
        {
            path: "/U2_B31",
            name: "2号B-31系統線図",
            component: U2_B31
        },
        {
            path: "/U2_B34",
            name: "2号B-34系統線図",
            component: U2_B34
        },
        {
            path: "/U2_B35",
            name: "2号B-35系統線図",
            component: U2_B35
        },
        {
            path: "/U2_B36",
            name: "2号B-36系統線図",
            component: U2_B36
        },
        {
            path: "/U2_B37",
            name: "2号B-37系統線図",
            component: U2_B37
        },
        {
            path: "/U2_B38",
            name: "2号B-38系統線図",
            component: U2_B38
        },
        {
            path: "/U2_B39",
            name: "2号B-39系統線図",
            component: U2_B39
        },
        {
            path: "/U2_B40",
            name: "2号B-40系統線図",
            component: U2_B40
        },
        {
            path: "/U2_B41",
            name: "2号B-41系統線図",
            component: U2_B41
        },

        //  ------------------------- 1号タービン -------------------------

        {
            path: "/U1_T3",
            name: "1号T-3系統線図",
            component: U1_T3
        },
        {
            path: "/U1_T4",
            name: "1号T-4系統線図",
            component: U1_T4
        },
        {
            path: "/U1_T5",
            name: "1号T-5系統線図",
            component: U1_T5
        },
        {
            path: "/U1_T6",
            name: "1号T-6系統線図",
            component: U1_T6
        },
        {
            path: "/U1_T7",
            name: "1号T-7系統線図",
            component: U1_T7
        },
        {
            path: "/U1_T8",
            name: "1号T-8系統線図",
            component: U1_T8
        },
        {
            path: "/U1_T9",
            name: "1号T-9系統線図",
            component: U1_T9
        },
        {
            path: "/U1_T10",
            name: "1号T-10系統線図",
            component: U1_T10
        },
        {
            path: "/U1_T11",
            name: "1号T-11系統線図",
            component: U1_T11
        },
        {
            path: "/U1_T12",
            name: "1号T-12系統線図",
            component: U1_T12
        },
        {
            path: "/U1_T13",
            name: "1号T-13系統線図",
            component: U1_T13
        },
        {
            path: "/U1_T16",
            name: "1号T-16系統線図",
            component: U1_T16
        },
        {
            path: "/U1_T19",
            name: "1号T-19系統線図",
            component: U1_T19
        },
        {
            path: "/U1_T20",
            name: "1号T-20系統線図",
            component: U1_T20
        },
        {
            path: "/U1_T25",
            name: "1号T-25系統線図",
            component: U1_T25
        },
        {
            path: "/U1_T26",
            name: "1号T-26系統線図",
            component: U1_T26
        },
        {
            path: "/U1_T28",
            name: "1号T-28系統線図",
            component: U1_T28
        },
        {
            path: "/U1_T30",
            name: "1号T-30系統線図",
            component: U1_T30
        },
        {
            path: "/U1_T31",
            name: "1号T-31系統線図",
            component: U1_T31
        },
        {
            path: "/U1_T32",
            name: "1号T-32系統線図",
            component: U1_T32
        },
        {
            path: "/U1_T33",
            name: "1号T-33系統線図",
            component: U1_T33
        },
        {
            path: "/U1_T36",
            name: "1号T-36系統線図",
            component: U1_T36
        },
        //  ------------------------- 2号タービン -------------------------
        {
            path: "/U2_T1",
            name: "2号T-1系統線図",
            component: U2_T1
        },
        {
            path: "/U2_T2",
            name: "2号T-2系統線図",
            component: U2_T2
        },
        {
            path: "/U2_T2",
            name: "2号T-2系統線図",
            component: U2_T2
        },
        {
            path: "/U2_T3",
            name: "2号T-3系統線図",
            component: U2_T3
        },
        {
            path: "/U2_T4",
            name: "2号T-4系統線図",
            component: U2_T4
        },
        {
            path: "/U2_T5",
            name: "2号T-5系統線図",
            component: U2_T5
        },
        {
            path: "/U2_T6",
            name: "2号T-6系統線図",
            component: U2_T6
        },
        {
            path: "/U2_T7",
            name: "2号T-7系統線図",
            component: U2_T7
        },
        {
            path: "/U2_T8",
            name: "2号T-8系統線図",
            component: U2_T8
        },
        {
            path: "/U2_T9",
            name: "2号T-9系統線図",
            component: U2_T9
        },
        {
            path: "/U2_T10",
            name: "2号T-10系統線図",
            component: U2_T10
        },
        {
            path: "/U2_T11",
            name: "2号T-11系統線図",
            component: U2_T11
        },
        {
            path: "/U2_T12",
            name: "2号T-12系統線図",
            component: U2_T12
        },
        {
            path: "/U2_T13",
            name: "2号T-13系統線図",
            component: U2_T13
        },
        {
            path: "/U2_T16",
            name: "2号T-16系統線図",
            component: U2_T16
        },
        {
            path: "/U2_T19",
            name: "2号T-19系統線図",
            component: U2_T19
        },
        {
            path: "/U2_T20",
            name: "2号T-20系統線図",
            component: U2_T20
        },
        {
            path: "/U2_T25",
            name: "2号T-25系統線図",
            component: U2_T25
        },
        {
            path: "/U2_T26",
            name: "2号T-26系統線図",
            component: U2_T26
        },
        {
            path: "/U2_T28",
            name: "2号T-28系統線図",
            component: U2_T28
        },
        {
            path: "/U2_T30",
            name: "2号T-30系統線図",
            component: U2_T30
        },
        {
            path: "/U2_T31",
            name: "2号T-31系統線図",
            component: U2_T31
        },
        {
            path: "/U2_T32",
            name: "2号T-32系統線図",
            component: U2_T32
        },
        {
            path: "/U2_T33",
            name: "2号T-33系統線図",
            component: U2_T33
        },
        {
            path: "/U2_T36",
            name: "2号T-36系統線図",
            component: U2_T36
        },
        //  ------------------------- 1号電気 -------------------------
        {
            path: "/U1_E27",
            name: "1号E-27系統線図",
            component: U1_E27
        },
        {
            path: "/U1_E29",
            name: "1号E-29系統線図",
            component: U1_E29
        },
        {
            path: "/U1_E30",
            name: "1号E-30系統線図",
            component: U1_E30
        },
        {
            path: "/U1_E31",
            name: "1号E-31系統線図",
            component: U1_E31
        },
        //  ------------------------- 2号電気 -------------------------
        {
            path: "/U2_E28",
            name: "2号E-28系統線図",
            component: U2_E28
        },
        {
            path: "/U2_E29",
            name: "2号E-29系統線図",
            component: U2_E29
        },
        {
            path: "/U2_E30",
            name: "2号E-30系統線図",
            component: U2_E30
        },
        {
            path: "/U2_E31",
            name: "2号E-31系統線図",
            component: U2_E31
        }
    ]
});
