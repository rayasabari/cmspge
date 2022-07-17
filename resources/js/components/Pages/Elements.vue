<template>
  <div>
    <Card
      :shadow="false"
      :border="true"
      class="mb-4"
      v-for="(element, index) in elements"
      :key="index"
    >
      <div class="d-flex justify-content-between align-items-center">
        <span>{{ element.name }}</span>
        <a
          href="#"
          @click="$parent.$parent.addContent(element)"
          data-bs-toggle="modal"
          data-bs-target="#contentModal"
          class="text-primary"
        >Add</a>
      </div>
    </Card>
  </div>
</template>

<script>
import Card from "../Base/Card.vue";
export default {
  name: "Elements",
  props: ["elements"],
  components: {
    Card,
  },
};
</script>

<style>
</style>