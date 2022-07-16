<template>
  <div class="card" :class="cardStyle">
    <div v-if="title" class="card-header">
      <h3 class="card-title">{{title}}</h3>
      <div class="card-toolbar">
        <slot name="toolbar" />
      </div>
    </div>
    <div class="card-body">
      <slot />
    </div>
    <div v-if="footer" class="card-footer">
      <slot name="footer" />
    </div>
  </div>
</template>

<script>
export default {
  name: "Card",
  props: {
    title: {
      type: String,
      default: "",
    },
    footer: {
      type: Boolean,
      default: false,
    },
    shadow: {
      type: Boolean,
      default: true,
    },
    border: {
      type: Boolean,
      default: false,
    },
  },
  computed: {
    cardStyle() {
      let hasShadow = this.shadow ? "shadow-sm" : "";
      let hasBorder = this.border ? "border" : "";
      return hasShadow + " " + hasBorder;
    },
  },
};
</script>

<style>
</style>