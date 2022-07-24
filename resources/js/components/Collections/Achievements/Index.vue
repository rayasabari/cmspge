<template>
  <div>
    <Card title="Achievements" :footer="achievements.data && achievements.last_page != 1">
      <template v-slot:toolbar>
        <button
          @click="addAchievement()"
          type="button"
          data-bs-toggle="modal"
          data-bs-target="#achievementModal"
          class="btn btn-sm btn-primary"
        >Add New</button>
      </template>
      <div v-if="achievements.total > 0" class="table-responsive">
        <table class="table table-hover table-row-bordered">
          <thead>
            <tr class="fw-bold fs-6 text-gray-800">
              <th class="text-center">#</th>
              <th>Name</th>
              <th>Descriptions</th>
              <th class="text-center">Date</th>
              <th class="text-center" width="22%">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(achievement, index) in achievements.data" :key="index">
              <td class="text-center">{{ index +1 }}</td>
              <td>{{ achievement.name }}</td>
              <td>{{ achievement.description }}</td>
              <td class="text-center text-muted">{{ achievement.Created }}</td>
              <td class="text-center">
                <span class="d-flex justify-content-center gap-4 fw-bold">
                  <a
                    href="#"
                    @click.prevent="editAchievement(achievement)"
                    class="text-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#achievementModal"
                  >Edit</a>
                  <a href="#" @click.prevent="confirmDelete(achievement)" class="text-danger">Delete</a>
                </span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div v-else>
        <EmptyDataAlert @on-click-add="addAchievement" target="#achievementModal" />
      </div>
      <template v-slot:footer>
        <Pagination :data="achievements" @fetch-data="fetchData" />
      </template>
    </Card>

    <!-- Begin::Modal Form  -->
    <form @submit.prevent="onSubmit">
      <Modal :title="action+' Achievement'" modalId="achievementModal">
        <Form ref="achievementForm" @fetch-data="refetch" />
        <template v-slot:footer>
          <button type="button" ref="closeModal" class="btn btn-light" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-sm">Submit</button>
        </template>
      </Modal>
    </form>
    <!-- End::Modal Form  -->
  </div>
</template>

<script>
import Card from "../../Base/Card.vue";
import Pagination from "../../Base/Pagination.vue";
import Modal from "../../Base/Modal.vue";
import Form from "./Form.vue";
import EmptyDataAlert from "../../Base/EmptyDataAlert.vue";
export default {
  name: "Achievements",
  components: {
    Card,
    Pagination,
    Modal,
    Form,
    EmptyDataAlert,
  },
  data() {
    return {
      achievements: [],
      action: "",
    };
  },
  mounted() {
    this.fetchData();
  },
  methods: {
    fetchData(url = "/collections/achievements/get?page=1") {
      this.$axios
        .get(url)
        .then((response) => {
          this.achievements = response.data.data;
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    addAchievement() {
      this.action = "Add";
      this.$refs.achievementForm.clearData();
    },
    editAchievement(achievement) {
      this.action = "Edit";
      this.$refs.achievementForm.getData(achievement);
    },
    onSubmit() {
      this.$refs.achievementForm.submitData();
    },
    confirmDelete(achievement) {
      Swal.fire({
        html: `Are you sure you want to delete ${achievement.name}?`,
        icon: "info",
        buttonsStyling: false,
        showCancelButton: true,
        confirmButtonText: "Ok, got it!",
        cancelButtonText: "Nope, cancel it",
        customClass: {
          confirmButton: "btn btn-primary",
          cancelButton: "btn btn-danger",
        },
      })
        .then((result) => {
          if (result.value) {
            this.deleteAchievement(achievement);
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    deleteAchievement(achievement) {
      this.$axios
        .delete(`/collections/achievements/delete/${achievement.id}`)
        .then((response) => {
          this.Notify.success(response.data.message);
          this.fetchData();
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    refetch() {
      this.$refs.closeModal.click();
      this.fetchData();
    },
  },
};
</script>

<style>
</style>