<template>
  <div>
    <Card title="Services" :footer="services.data && services.last_page != 1">
      <template v-slot:toolbar>
        <button
          @click="addService()"
          type="button"
          data-bs-toggle="modal"
          data-bs-target="#serviceModal"
          class="btn btn-sm btn-primary"
        >Add New</button>
      </template>
      <div v-if="services.total > 0" class="table-responsive">
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
            <tr v-for="(service, index) in services.data" :key="index">
              <td class="text-center">{{ index +1 }}</td>
              <td>{{ service.name }}</td>
              <td>{{ service.description }}</td>
              <td class="text-center">{{ service.Created }}</td>
              <td class="text-center">
                <span class="d-flex justify-content-center gap-4 fw-bold">
                  <a
                    href="#"
                    @click.prevent="editService(service)"
                    class="text-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#serviceModal"
                  >Edit</a>
                  <a href="#" @click.prevent="confirmDelete(service)" class="text-danger">Delete</a>
                </span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div v-else>
        <EmptyDataAlert @on-click-add="addService" target="#serviceModal" />
      </div>
      <template v-slot:footer>
        <Pagination :data="services" @fetch-data="fetchData" />
      </template>
    </Card>

    <!-- Begin::Modal Form  -->
    <form @submit.prevent="onSubmit">
      <Modal :title="action+' Service'" modalId="serviceModal">
        <ServiceForm ref="serviceForm" @fetch-data="refetch" />
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
import ServiceForm from "./ServiceForm.vue";
import EmptyDataAlert from "../../Base/EmptyDataAlert.vue";
export default {
  name: "Services",
  components: {
    Card,
    Pagination,
    Modal,
    ServiceForm,
    EmptyDataAlert,
  },
  data() {
    return {
      services: [],
      action: "",
    };
  },
  mounted() {
    this.fetchData();
  },
  methods: {
    fetchData(url = "/collections/services/get?page=1") {
      this.$axios
        .get(url)
        .then((response) => {
          this.services = response.data.data;
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    addService() {
      this.action = "Add";
      this.$refs.serviceForm.clearData();
    },
    editService(service) {
      this.action = "Edit";
      this.$refs.serviceForm.getData(service);
    },
    onSubmit() {
      this.$refs.serviceForm.submitData();
    },
    confirmDelete(service) {
      Swal.fire({
        html: `Are you sure you want to delete ${service.name}?`,
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
            this.deleteService(service);
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    deleteService(service) {
      this.$axios
        .delete(`/collections/services/delete/${service.id}`)
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