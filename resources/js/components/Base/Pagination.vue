<template>
  <ul class="pagination pagination-outline">
    <li :class="data.prev_page_url == null ? 'disabled' : ''" class="page-item previous m-1">
      <a
        href="#"
        @click.prevent="data.prev_page_url ? fetchData(data.prev_page_url) : ''"
        class="page-link"
      >
        <i class="previous"></i>
      </a>
    </li>
    <template v-for="(link, index) in data.links">
      <li
        :key="index"
        v-if="index != 0 && index !=  data.links.length - 1"
        class="page-item m-1"
        :class="link.active ? 'active' : ''"
      >
        <a
          href="#"
          @click.prevent="link.url !== null ? fetchData(link.url) : '' "
          class="page-link"
        >{{ link.label }}</a>
      </li>
    </template>
    <li :class="data.next_page_url == null ? 'disabled' : ''" class="page-item next m-1">
      <a
        href="#"
        @click.prevent="data.next_page_url !== null ? fetchData(data.next_page_url) : ''"
        class="page-link"
      >
        <i class="next"></i>
      </a>
    </li>
  </ul>
</template>

<script>
export default {
  name: "Pagination",
  props: ["data"],
  methods: {
    fetchData(url) {
      this.$parent.$parent.fetchData(url);
    },
  },
};
</script>

<style>
</style>