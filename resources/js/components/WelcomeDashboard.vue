<template>
  <div class="mb-8">
    <h1>Hello {{ name }}!</h1>
    <p>
      Welcome to
      <span class="fst-italic">
        <b class="fw-bold">RYSB</b> Admin
      </span>
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