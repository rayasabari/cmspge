<template>
  <div>
    <div class="fv-row mb-4">
      <label class="fs-6 fw-semibold form-label mt-3">
        <span>Title</span>
      </label>
      <input
        type="text"
        class="form-control form-control-solid"
        v-model="page.title"
        @input="slugGenerator()"
      />
      <span v-if="errors.title" class="text-danger fs-8">{{ errors.title[0] }}</span>
    </div>

    <div class="fv-row mb-4">
      <label class="fs-6 fw-semibold form-label mt-3">
        <span>Slug</span>
      </label>
      <input type="text" class="form-control form-control-solid" v-model="page.slug" />
      <span v-if="errors.slug" class="text-danger fs-8">{{ errors.slug[0] }}</span>
    </div>

    <div class="fv-row mb-4">
      <label class="fs-6 fw-semibold form-label mt-3">
        <span>Meta Description</span>
      </label>
      <textarea
        class="form-control form-control-lg form-control-solid"
        rows="2"
        v-model="page.meta_description"
      ></textarea>
    </div>

    <div class="fv-row mb-4">
      <label class="fs-6 fw-semibold form-label mt-3">
        <span>Front Path</span>
      </label>
      <input
        type="text"
        class="form-control form-control-lg form-control-solid"
        v-model="page.front_path"
      />
    </div>
  </div>
</template>

<script>
export default {
  name: "InputForm",
  data() {
    return {
      page: {
        title: "",
        slug: "",
        meta_description: "",
        front_path: "",
        action: ''
      },
      errors: {},
    };
  },
  methods: {
    getData(page) {
      this.page = page;
      this.errors = {};
      this.page.action = "Edit";
    },
    clearData() {
      this.page = {
        parent_id: null,
        title: "",
        slug: "",
        meta_description: "",
        front_path: "",
      };
      this.errors = {};
      this.page.action = "Add";
    },
    submitData() {
      this.$axios
        .post("/pages/submit", this.page)
        .then((response) => {
          this.Notify.success(response.data.message);
          this.$root.$emit("refetch");
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          this.Notify.failure(error.response.data.message);
        });
    },
    slugGenerator() {
      this.page.slug = this.page.title
        .toLowerCase()
        .replace(/ /g, "-")
        .replace(/[^\w-]+/g, "");
    },
  },
};
</script>

<style>
</style>