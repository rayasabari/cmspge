<template>
  <div>
    <div class="fv-row mb-4">
      <label class="fs-6 fw-semibold form-label mt-3">
        <span>Name</span>
      </label>
      <input type="text" class="form-control form-control-solid" v-model="service.name" />
      <span v-if="errors.name" class="text-danger fs-8">{{ errors.name[0] }}</span>
    </div>

    <div class="fv-row mb-4">
      <label class="fs-6 fw-semibold form-label mt-3">
        <span>Description</span>
      </label>
      <textarea
        class="form-control form-control-lg form-control-solid"
        rows="5"
        v-model="service.description"
      ></textarea>
    </div>

    <div class="fv-row mb-4">
      <label class="fs-6 fw-semibold form-label mt-3">
        <span>Url</span>
      </label>
      <input
        type="text"
        class="form-control form-control-lg form-control-solid"
        v-model="service.url"
      />
    </div>
  </div>
</template>

<script>
export default {
  name: "ServiceForm",
  data() {
    return {
      service: {
        name: "",
        description: "",
        url: "",
        action: "",
      },
      errors: {},
    };
  },
  methods: {
    getData(service) {
      this.service = {
        id: service.id,
        name: service.name,
        description: service.description,
        url: service.url,
      };
      this.errors = {};
      this.service.action = "Edit";
    },
    clearData() {
      this.service = {
        name: "",
        description: "",
        url: "",
      };
      this.errors = {};
      this.service.action = "Add";
    },
    submitData() {
      this.$axios
        .post("/collections/services/submit", this.service)
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