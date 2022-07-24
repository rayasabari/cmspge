<template>
  <div>
    <div class="fv-row mb-4">
      <label class="fs-6 fw-semibold form-label mt-3">
        <span>Name</span>
      </label>
      <input type="text" class="form-control form-control-solid" v-model="achievement.name" />
      <span v-if="errors.name" class="text-danger fs-8">{{ errors.name[0] }}</span>
    </div>

    <div class="fv-row mb-4">
      <label class="fs-6 fw-semibold form-label mt-3">
        <span>Description</span>
      </label>
      <textarea
        class="form-control form-control-lg form-control-solid"
        rows="5"
        v-model="achievement.description"
      ></textarea>
    </div>

    <div class="fv-row mb-4">
      <label class="fs-6 fw-semibold form-label mt-3">
        <span>Image</span>
      </label>
      <input
        type="text"
        class="form-control form-control-lg form-control-solid"
        v-model="achievement.image"
      />
    </div>

    <div class="fv-row mb-4">
      <label class="fs-6 fw-semibold form-label mt-3">
        <span>Url</span>
      </label>
      <input
        type="text"
        class="form-control form-control-lg form-control-solid"
        v-model="achievement.url"
      />
    </div>
  </div>
</template>

<script>
export default {
  name: "AchievementForm",
  data() {
    return {
      achievement: {
        name: "",
        description: "",
        image: "",
        url: "",
        action: "",
      },
      errors: {},
    };
  },
  methods: {
    getData(achievement) {
      this.achievement = {
        id: achievement.id,
        name: achievement.name,
        description: achievement.description,
        image: achievement.image,
        url: achievement.url,
      };
      this.errors = {};
      this.achievement.action = "Edit";
    },
    clearData() {
      this.achievement = {
        name: "",
        description: "",
        image: '',
        url: "",
      };
      this.errors = {};
      this.achievement.action = "Add";
    },
    submitData() {
      this.$axios
        .post("/collections/achievements/submit", this.achievement)
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