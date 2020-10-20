<template>
  <v-app>
    <div>テストVue</div>
    <div>{{historyNumber}}</div>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      historyNumber:this.$store.state.historyNumber[0],
    }
  },
}
</script>

<style scoped>

</style>