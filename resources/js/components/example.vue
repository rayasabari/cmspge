<template>
  <div class="mb-8">
    <h1>Hello World</h1>
    <p>This is a simple example of a Vue.js component.</p>
    <p>{{ message }}</p>
    <button type="button" class="btn btn-primary sm" @click="changeMessage">CLick</button>
  </div>
</template>

<script>
export default {
  name: "Example",
  data() {
    return {
      message: "Welcome to Your Vue.js App",
    };
  },
  methods: {
    changeMessage() {
      this.message = "Welcome to Black Parade";
    },
  },
};
</script>

<style>
</style>