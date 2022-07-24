<template>
  <div>
    <Card title="Values" :footer="values.data && values.last_page != 1">
      <template v-slot:toolbar>
        <button
          @click="addValue()"
          type="button"
          data-bs-toggle="modal"
          data-bs-target="#valueModal"
          class="btn btn-sm btn-primary"
        >Add New</button>
      </template>
      <div v-if="values.total > 0" class="table-responsive">
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
            <tr v-for="(value, index) in values.data" :key="index">
              <td class="text-center">{{ index +1 }}</td>
              <td>{{ value.name }}</td>
              <td>{{ value.description }}</td>
              <td class="text-center text-muted">{{ value.Created }}</td>
              <td class="text-center">
                <span class="d-flex justify-content-center gap-4 fw-bold">
                  <a
                    href="#"
                    @click.prevent="editValue(value)"
                    class="text-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#valueModal"
                  >Edit</a>
                  <a href="#" @click.prevent="confirmDelete(value)" class="text-danger">Delete</a>
                </span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div v-else>
        <EmptyDataAlert @on-click-add="addValue" target="#valueModal" />
      </div>
      <template v-slot:footer>
        <Pagination :data="values" @fetch-data="fetchData" />
      </template>
    </Card>

    <!-- Begin::Modal Form  -->
    <form @submit.prevent="onSubmit">
      <Modal :title="action+' Value'" modalId="valueModal">
        <Form ref="valueForm" @fetch-data="refetch" />
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
  name: "Values",
  components: {
    Card,
    Pagination,
    Modal,
    Form,
    EmptyDataAlert,
  },
  data() {
    return {
      values: [],
      action: "",
    };
  },
  mounted() {
    this.fetchData();
  },
  methods: {
    fetchData(url = "/collections/values/get?page=1") {
      this.$axios
        .get(url)
        .then((response) => {
          this.values = response.data.data;
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    addValue() {
      this.action = "Add";
      this.$refs.valueForm.clearData();
    },
    editValue(value) {
      this.action = "Edit";
      this.$refs.valueForm.getData(value);
    },
    onSubmit() {
      this.$refs.valueForm.submitData();
    },
    confirmDelete(value) {
      Swal.fire({
        html: `Are you sure you want to delete ${value.name}?`,
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
            this.deleteValue(value);
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    deleteValue(value) {
      this.$axios
        .delete(`/collections/values/delete/${value.id}`)
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