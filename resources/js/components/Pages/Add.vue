<template>
  <form @submit.prevent="onSubmit">
    <Card title="Add Page" :buttonLoading="buttonLoading">
      <div class="row mb-6">
        <label class="col-lg-4 col-form-label fw-semibold fs-6">Title</label>
        <div class="col-lg-8 fw-row">
          <input
            type="text"
            class="form-control form-control-lg form-control-solid"
            v-model="page.title"
            @input="slugGenerator()"
          />
        </div>
      </div>
      <div class="row mb-6">
        <label class="col-lg-4 col-form-label fw-semibold fs-6">Slug</label>
        <div class="col-lg-8 fw-row">
          <input
            type="text"
            class="form-control form-control-lg form-control-solid"
            v-model="page.slug"
          />
        </div>
      </div>
      <div class="row mb-6">
        <label class="col-lg-4 col-form-label fw-semibold fs-6">Meta Description</label>
        <div class="col-lg-8 fw-row">
          <textarea
            class="form-control form-control-lg form-control-solid"
            rows="4"
            v-model="page.meta_description"
          ></textarea>
        </div>
      </div>
      <div class="row mb-6">
        <label class="col-lg-4 col-form-label fw-semibold fs-6">Front Path</label>
        <div class="col-lg-8 fw-row">
          <input
            type="text"
            class="form-control form-control-lg form-control-solid"
            v-model="page.front_path"
          />
        </div>
      </div>
    </Card>
  </form>
</template>

<script>
import Card from "../Base/FormCard.vue";
export default {
  name: "AddPage",
  components: {
    Card,
  },
  data() {
    return {
      buttonLoading: false,
      page: {
        parent_id: null,
        title: "",
        slug: "",
        meta_description: "",
        front_path: "",
      },
    };
  },
  methods: {
    slugGenerator() {
      this.page.slug = this.page.title
        .toLowerCase()
        .replace(/ /g, "-")
        .replace(/[^\w-]+/g, "");
    },
    onSubmit() {
      this.buttonLoading = true;
      this.$axios
        .post("/pages/add", this.page)
        .then((response) => {
          console.log(response.data);
          setTimeout(() => {
            this.buttonLoading = false;
            this.Notify.success(response.data.message);
          }, 400);
        })
        .catch((error) => {
          console.log(error.response);
             this.buttonLoading = false;
            this.Notify.failure(error.response.data.message);
            console.log(error.response.message);
        });
    },
  },
};
</script>

<style>
</style>