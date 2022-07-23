<template>
  <dir class="text-center">
    <IconFileSearch size="svg-icon-5tx" />
    <div class="mt-8">
      <p>No data has been entry yet</p>
      <button
        @click="$emit('on-click-add')"
        type="button"
        data-bs-toggle="modal"
        :data-bs-target="target"
        class="btn btn-primary btn-sm btn-light-primary"
      >Add New</button>
    </div>
  </dir>
</template>

<script>
import IconFileSearch from "./Icons/FileSearch.vue";
export default {
  name: "NoData",
  props: ["target"],
  components: {
    IconFileSearch,
  },
};
</script>

<style>
</style>