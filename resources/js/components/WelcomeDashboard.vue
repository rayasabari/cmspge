<template>
  <div class="mb-8">
    <h1>Hello {{ name }}!</h1>
    <p class="">
      Welcome to
      <b class="fw-bold fst-italic">Ryapi</b>,
      the headless CMS by <b class="fw-bold fst-italic">RYSB</b>!
    </p>
  </div>
</template>

<script>
export default {
  name: "Example",
  props: ["name"],
};
</script>

<style>
</style>