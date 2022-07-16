<template>
  <div>
    <div class="fv-row mb-4">
      <label class="fs-6 fw-semibold form-label mt-3">
        <span>Title</span>
      </label>
      <input type="text" class="form-control form-control-solid" v-model="element.title" />
      <span v-if="errors.title" class="text-danger fs-8">{{ errors.title[0] }}</span>
    </div>

    <div class="fv-row mb-4">
      <label class="fs-6 fw-semibold form-label mt-3">
        <span>Sub Title</span>
      </label>
      <input type="text" class="form-control form-control-solid" v-model="element.sub_title" />
      <span v-if="errors.sub_title" class="text-danger fs-8">{{ errors.sub_title[0] }}</span>
    </div>

    <div class="fv-row mb-4">
      <label class="fs-6 fw-semibold form-label mt-3">
        <span>Text</span>
      </label>
      <textarea
        class="form-control form-control-lg form-control-solid"
        rows="3"
        v-model="element.text"
      ></textarea>
      <span v-if="errors.text" class="text-danger fs-8">{{ errors.text[0] }}</span>
    </div>
  </div>
</template>

<script>
export default {
  name: "ElementForm",
  data() {
    return {
      element: {
        title: "",
        sub_title: "",
        text: "",
        action: "",
      },
      errors: {},
    };
  },
  methods: {
    getData(data, action){
      this.element = data
      this.element.action = action;
      this.errors = {};
    },
    clearData(){
      this.element = {
        title: "",
        sub_title: "",
        text: "",
        action: "",
      }
      this.errors = {};
    }
  },
};
</script>

<style>
</style>