<template>
  <div>
    <Card title="Page Index" :footer="pages.last_page != 1">
      <template v-slot:toolbar>
        <button
          @click="addPage()"
          type="button"
          data-bs-toggle="modal"
          data-bs-target="#kt_modal_1"
          class="btn btn-sm btn-primary"
        >Add New</button>
      </template>
      <div v-if="pages.total > 0" class="table-responsive">
        <table class="table table-hover table-row-bordered">
          <thead>
            <tr class="fw-bold fs-6 text-gray-800">
              <th class="text-center">#</th>
              <th>Title</th>
              <th class="text-center">Author</th>
              <th class="text-center">Date</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(page, index) in pages.data" :key="index">
              <td class="text-center">{{ index +1 }}</td>
              <td>
                <a :href="`/pages/manage/${page.id}`" class="fw-bold">{{ page.title }}</a>
              </td>
              <td class="text-center">{{ page.user.first_name }}</td>
              <td class="text-center">{{ page.Created }}</td>
              <td class="text-center">
                <span class="d-flex justify-content-center gap-4 fw-bold">
                  <a
                    href="#"
                    @click.prevent="editPage(page)"
                    class="text-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#kt_modal_1"
                  >Edit</a>
                  <a :href="`/pages/manage/${page.id}`" class="text-info">Manage</a>
                  <a href="#" @click.prevent="confirmDelete(page)" class="text-danger">Delete</a>
                </span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div v-else>
        <Alert color="primary" title="Info" message="There is no page created yet!" />
      </div>
      <template v-slot:footer>Pagination</template>
    </Card>

    <!-- Begin::Modal Form  -->
    <form @submit.prevent="onSubmit">
      <Modal :title="action+' Page'">
        <InputForm ref="modalForm" />
        <template v-slot:submitButton>
          <button type="button" ref="closeModal" class="btn btn-light" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-sm">Submit</button>
        </template>
      </Modal>
    </form>
    <!-- End::Modal Form  -->
    
  </div>
</template>

<script>
import Card from "../Base/Card.vue";
import Alert from "../Base/Alert.vue";
import Modal from "../Base/Modal.vue";
import InputForm from "./InputForm.vue";
export default {
  name: "PageIndex",
  components: {
    Card,
    Alert,
    Modal,
    InputForm,
  },
  data() {
    return {
      title: "Page Index",
      pages: {},
      action: "",
    };
  },
  mounted() {
    this.fetchData();
    this.$root.$on("refetch", () => {
      this.$refs.closeModal.click();
      this.fetchData();
    });
  },
  methods: {
    fetchData() {
      this.$axios
        .get("/pages/getindex")
        .then((response) => {
          this.pages = response.data.data;
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    addPage() {
      this.action = "Add";
      this.$refs.modalForm.clearData();
    },
    editPage(page) {
      this.action = "Edit";
      this.$refs.modalForm.getData(page);
    },
    onSubmit() {
      this.$refs.modalForm.submitData();
    },
    confirmDelete(page) {
      this.Confirm.show(
        "Confirmation",
        `Are you sure you want to delete ${page.title} page?`,
        "Yes",
        "No",
        () => {
          this.deletePage(page);
        },
        () => {}
      );
    },
    deletePage(page) {
      this.$axios
        .delete(`/pages/delete/${page.id}`)
        .then((response) => {
          this.Notify.success(response.data.message);
          this.fetchData();
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
  },
};
</script>

<style>
</style>