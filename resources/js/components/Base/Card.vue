<template>
  <div class="card shadow-sm">
    <div class="card-header">
      <h3 class="card-title">{{title}}</h3>
      <div class="card-toolbar">
        <slot name="toolbar"/>
      </div>
    </div>
    <div class="card-body">
      <slot/>
    </div>
    <div v-if="footer" class="card-footer">
      <slot name="footer"/>
    </div>
  </div>
</template>

<script>
export default {
  name: "IndexCard",
  props: ['title', 'footer'],
};
</script>

<style>
</style>