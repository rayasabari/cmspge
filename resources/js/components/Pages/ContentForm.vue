<template>
  <div>
    <div class="fv-row mb-4">
      <label class="fs-6 fw-semibold form-label mt-3">
        <span>Title</span>
      </label>
      <input type="text" class="form-control form-control-solid" v-model="content.title" />
      <span v-if="errors.title" class="text-danger fs-8">{{ errors.title[0] }}</span>
    </div>

    <div class="fv-row mb-4">
      <label class="fs-6 fw-semibold form-label mt-3">
        <span>Sub Title</span>
      </label>
      <input type="text" class="form-control form-control-solid" v-model="content.sub_title" />
      <span v-if="errors.sub_title" class="text-danger fs-8">{{ errors.sub_title[0] }}</span>
    </div>

    <div class="fv-row mb-4">
      <label class="fs-6 fw-semibold form-label mt-3">
        <span>Text</span>
      </label>
      <textarea
        class="form-control form-control-lg form-control-solid"
        rows="3"
        v-model="content.text"
      ></textarea>
      <span v-if="errors.text" class="text-danger fs-8">{{ errors.text[0] }}</span>
    </div>
  </div>
</template>

<script>
export default {
  name: "ContentForm",
  data() {
    return {
      content: {
        page_id: "",
        element_id: "",
        title: "",
        sub_title: "",
        text: "",
        action: "",
      },
      errors: {},
    };
  },
  methods: {
    getData(content) {
      this.content = {
        id: content.id,
        page_id: content.page_id,
        element_id: content.element_id,
        title: content.title,
        sub_title: content.sub_title,
        text: content.text,
        action: "Edit",
      };
      this.errors = {};
    },
    clearData(pageId, elementId) {
      this.content = {
        page_id: pageId,
        element_id: elementId,
        title: "",
        sub_title: "",
        text: "",
        action: "Add",
      };
      this.errors = {};
    },
    submitData() {
      this.$axios
        .post("/pages/content-manager/submit", this.content)
        .then((response) => {
          console.log(response);
          this.Notify.success(response.data.message);
          this.$root.$emit("refetch");
        })
        .catch((error) => {
          console.log(error.response);
          // this.errors = error.response.data.errors;
          // this.Notify.failure(error.response.data.message);
        });
    },
  },
};
</script>

<style>
</style>