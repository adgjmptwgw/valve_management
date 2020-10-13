<template>
    <div>
        <button  @click="ChangeClass()" :style="{display:isActive}">
            <slot name="btn-name"></slot>
        </button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isActive:"block"
        };
    },

  methods: {
    ChangeClass(){
      // this.isActive = "none"
    }
  },
};
</script>

<style>
</style>
