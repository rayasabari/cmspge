<template>
  <div>
    <div class="fv-row mb-4">
      <label class="fs-6 fw-semibold form-label mt-3">
        <span>Name</span>
      </label>
      <input type="text" class="form-control form-control-solid" v-model="staff.name" />
      <span v-if="errors.name" class="text-danger fs-8">{{ errors.name[0] }}</span>
    </div>

    <div class="fv-row mb-4">
      <label class="fs-6 fw-semibold form-label mt-3">
        <span>Position</span>
      </label>
      <input type="text" class="form-control form-control-solid" v-model="staff.position" />
      <span v-if="errors.position" class="text-danger fs-8">{{ errors.position[0] }}</span>
    </div>

    <div class="fv-row mb-4">
      <label class="fs-6 fw-semibold form-label mt-3">
        <span>Bio</span>
      </label>
      <textarea
        class="form-control form-control-lg form-control-solid"
        rows="5"
        v-model="staff.bio"
      ></textarea>
      <span v-if="errors.bio" class="text-danger fs-8">{{ errors.bio[0] }}</span>
    </div>

    <div class="fv-row mb-4">
      <label class="fs-6 fw-semibold form-label mt-3">
        <span>Image</span>
      </label>
      <input
        type="text"
        class="form-control form-control-lg form-control-solid"
        v-model="staff.image"
      />
    </div>
  </div>
</template>

<script>
export default {
  name: "StaffForm",
  data() {
    return {
      staff: {
        name: "",
        position: "",
        bio: "",
        image: "",
      },
      errors: {},
    };
  },
  methods: {
    getData(staff) {
      this.staff = {
        id: staff.id,
        name: staff.name,
        position: staff.position,
        bio: staff.bio,
        image: staff.image,
      };
      this.errors = {};
      this.staff.action = "Edit";
    },
    clearData() {
      this.staff = {
        name: "",
        position: "",
        bio: "",
        image: "",
      };
      this.errors = {};
      this.staff.action = "Add";
    },
    submitData() {
      this.$axios
        .post("/collections/staff/submit", this.staff)
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