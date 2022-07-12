<template>
  <div class="card shadow-sm">
    <div class="card-header">
      <h3 class="card-title">{{ title }}</h3>
      <div class="card-toolbar">
        <slot name="toolbar"></slot>
      </div>
    </div>
    <div class="card-body">
      <slot />
    </div>
    <div class="card-footer">
      <div class="d-flex justify-content-between">
        <div class="text-muted">
          <span v-if="lastUpdated">Last updated: {{ lastUpdated }}</span>
        </div>
        <button type="submit" class="btn btn-primary" :class="buttonLoading ? 'disabled': ''">
          {{ buttonLoading ? 'Saving...' : 'Submit' }}
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "BaseFormCard",
  props: ["title", "lastUpdated", "buttonLoading"],
};
</script>

<style>
</style>