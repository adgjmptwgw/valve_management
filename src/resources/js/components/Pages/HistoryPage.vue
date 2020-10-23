<template>
    <v-app>
        <div>テストVue</div>
        <router-link to="/HistoryPage">
            <p class="u1_history">テスト</p>
        </router-link>

        <div>
            <router-view />
        </div>
    </v-app>
</template>

<script>
export default {
    data() {}
};
</script>

<style scoped></style>
