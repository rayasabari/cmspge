<template>
  <div>
    <div class="fv-row mb-4">
      <label class="fs-6 fw-semibold form-label mt-3">
        <span>Name</span>
      </label>
      <input type="text" class="form-control form-control-solid" v-model="expertise.name" />
      <span v-if="errors.name" class="text-danger fs-8">{{ errors.name[0] }}</span>
    </div>

    <div class="fv-row mb-4">
      <label class="fs-6 fw-semibold form-label mt-3">
        <span>Description</span>
      </label>
      <textarea
        class="form-control form-control-lg form-control-solid"
        rows="4"
        v-model="expertise.description"
      ></textarea>
      <span v-if="errors.description" class="text-danger fs-8">{{ errors.description[0] }}</span>
    </div>

    <div class="fv-row mb-4">
      <label class="fs-6 fw-semibold form-label mt-3">
        <span>Url</span>
      </label>
      <input
        type="text"
        class="form-control form-control-lg form-control-solid"
        v-model="expertise.url"
      />
    </div>

    <div class="fv-row mb-4">
      <label class="fs-6 fw-semibold form-label mt-3">
        <span>Image</span>
      </label>
      <input
        type="text"
        class="form-control form-control-lg form-control-solid"
        v-model="expertise.image"
      />
    </div>
  </div>
</template>

<script>
export default {
  name: "ExpertiseForm",
  data() {
    return {
      expertise: {
        name: "",
        description: "",
        url: "",
        image: "",
        action: "",
      },
      errors: {},
    };
  },
  methods: {
    getData(expertise) {
      this.expertise = {
        id: expertise.id,
        name: expertise.name,
        description: expertise.description,
        url: expertise.url,
        image: expertise.image,
      };
      this.errors = {};
      this.expertise.action = "Edit";
    },
    clearData() {
      this.expertise = {
        name: '',
        description: '',
        url: '',
        image:'',
      };
      this.errors = {};
      this.expertise.action = "Add";
    },
    submitData() {
      this.$axios
        .post("/collections/expertise/submit", this.expertise)
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