<template>
  <div>
    <div class="fv-row mb-4">
      <label class="fs-6 fw-semibold form-label mt-3">
        <span>Name</span>
      </label>
      <input type="text" class="form-control form-control-solid" v-model="value.name" />
      <span v-if="errors.name" class="text-danger fs-8">{{ errors.name[0] }}</span>
    </div>

    <div class="fv-row mb-4">
      <label class="fs-6 fw-semibold form-label mt-3">
        <span>Description</span>
      </label>
      <textarea
        class="form-control form-control-lg form-control-solid"
        rows="5"
        v-model="value.description"
      ></textarea>
    </div>

    <div class="fv-row mb-4">
      <label class="fs-6 fw-semibold form-label mt-3">
        <span>Image</span>
      </label>
      <input
        type="text"
        class="form-control form-control-lg form-control-solid"
        v-model="value.image"
      />
    </div>
  </div>
</template>

<script>
export default {
  name: "ValuesForm",
  data() {
    return {
      value: {
        name: "",
        description: "",
        url: "",
        action: "",
      },
      errors: {},
    };
  },
  methods: {
    getData(value) {
      this.value = {
        id: value.id,
        name: value.name,
        description: value.description,
        image: value.image,
      };
      this.errors = {};
      this.value.action = "Edit";
    },
    clearData() {
      this.value = {
        name: "",
        description: "",
        image: "",
      };
      this.errors = {};
      this.value.action = "Add";
    },
    submitData() {
      this.$axios
        .post("/collections/values/submit", this.value)
        .then((response) => {
          this.Notify.success(response.data.message);
          this.$emit("fetch-data");
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          this.Notify.failure(error.response.data.message);
        });
    },
  },
};
</script>

<style>
</style>