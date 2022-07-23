<template>
  <div>
    <Card title="Staff" :footer="staff.data && staff.last_page != 1">
      <template v-slot:toolbar>
        <button
          @click="addStaff()"
          type="button"
          data-bs-toggle="modal"
          data-bs-target="#staffModal"
          class="btn btn-sm btn-primary"
        >Add New</button>
      </template>
      <div v-if="staff.total > 0" class="table-responsive">
        <table class="table table-hover table-row-bordered">
          <thead>
            <tr class="fw-bold fs-6 text-gray-800">
              <th class="text-center">#</th>
              <th>Name</th>
              <th>Position</th>
              <th>Bio</th>
              <th class="text-center">Date</th>
              <th class="text-center" width="22%">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(staff, index) in staff.data" :key="index">
              <td class="text-center">{{ index +1 }}</td>
              <td>{{ staff.name }}</td>
              <td>{{ staff.position }}</td>
              <td>{{ staff.bio }}</td>
              <td class="text-center">{{ staff.Created }}</td>
              <td class="text-center">
                <span class="d-flex justify-content-center gap-4 fw-bold">
                  <a
                    href="#"
                    @click.prevent="editStaff(staff)"
                    class="text-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#staffModal"
                  >Edit</a>
                  <a href="#" @click.prevent="confirmDelete(staff)" class="text-danger">Delete</a>
                </span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div v-else>
        <EmptyDataAlert @on-click-add="addStaff" target="#staffModal" />
      </div>
      <template v-slot:footer>
        <Pagination :data="staff" @fetch-data="fetchData" />
      </template>
    </Card>

    <!-- Begin::Modal Form  -->
    <form @submit.prevent="onSubmit">
      <Modal :title="action+' Staff'" modalId="staffModal">
        <Form ref="staffForm" @fetch-data="refetch" />
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
  name: "Staff",
  components: {
    Card,
    Pagination,
    Modal,
    Form,
    EmptyDataAlert,
  },
  data() {
    return {
      staff: [],
      action: "",
    };
  },
  mounted() {
    this.fetchData();
  },
  methods: {
    fetchData(url = "/collections/staff/get?page=1") {
      this.$axios
        .get(url)
        .then((response) => {
          this.staff = response.data.data;
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    addStaff() {
      this.action = "Add";
      this.$refs.staffForm.clearData();
    },
    editStaff(staff) {
      this.action = "Edit";
      this.$refs.staffForm.getData(staff);
    },
    onSubmit() {
      this.$refs.staffForm.submitData();
    },
    confirmDelete(staff) {
      Swal.fire({
        html: `Are you sure you want to delete ${staff.name}?`,
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
            this.deleteStaff(staff);
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    deleteStaff(staff) {
      this.$axios
        .delete(`/collections/staff/delete/${staff.id}`)
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