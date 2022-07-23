<template>
  <div>
    <Card title="Expertise" :footer="expertise.data && expertise.last_page != 1">
      <template v-slot:toolbar>
        <button
          @click="addExpertise()"
          type="button"
          data-bs-toggle="modal"
          data-bs-target="#expertiseModal"
          class="btn btn-sm btn-primary"
        >Add New</button>
      </template>
      <div v-if="expertise.total > 0" class="table-responsive">
        <table class="table table-hover table-row-bordered">
          <thead>
            <tr class="fw-bold fs-6 text-gray-800">
              <th class="text-center">#</th>
              <th>Name</th>
              <th>Description</th>
              <th class="text-center">Date</th>
              <th class="text-center" width="22%">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(expertise, index) in expertise.data" :key="index">
              <td class="text-center">{{ index +1 }}</td>
              <td>{{ expertise.name }}</td>
              <td>{{ expertise.description }}</td>
              <td class="text-center">{{ expertise.Created }}</td>
              <td class="text-center">
                <span class="d-flex justify-content-center gap-4 fw-bold">
                  <a
                    href="#"
                    @click.prevent="editExpertise(expertise)"
                    class="text-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#expertiseModal"
                  >Edit</a>
                  <a href="#" @click.prevent="confirmDelete(expertise)" class="text-danger">Delete</a>
                </span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div v-else>
        <EmptyDataAlert @on-click-add="addExpertise" target="#expertiseModal" />
      </div>
      <template v-slot:footer>
        <Pagination :data="expertise" @fetch-data="fetchData" />
      </template>
    </Card>

    <!-- Begin::Modal Form  -->
    <form @submit.prevent="onSubmit">
      <Modal :title="action+' Expertise'" modalId="expertiseModal">
        <Form ref="expertiseForm" @fetch-data="refetch" />
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
import Form from "../Expertise/Form.vue";
import EmptyDataAlert from "../../Base/EmptyDataAlert.vue";
export default {
  name: "Expertise",
  components: {
    Card,
    Pagination,
    Modal,
    Form,
    EmptyDataAlert,
  },
  data() {
    return {
      expertise: [],
      action: "",
    };
  },
  mounted() {
    this.fetchData();
  },
  methods: {
    fetchData(url = "/collections/expertise/get?page=1") {
      this.$axios
        .get(url)
        .then((response) => {
          this.expertise = response.data.data;
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    addExpertise() {
      this.action = "Add";
      this.$refs.expertiseForm.clearData();
    },
    editExpertise(expertise) {
      this.action = "Edit";
      this.$refs.expertiseForm.getData(expertise);
    },
    onSubmit() {
      this.$refs.expertiseForm.submitData();
    },
    confirmDelete(expertise) {
      Swal.fire({
        html: `Are you sure you want to delete ${expertise.name}?`,
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
            this.deleteExpertise(expertise);
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    deleteExpertise(expertise) {
      this.$axios
        .delete(`/collections/expertise/delete/${expertise.id}`)
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