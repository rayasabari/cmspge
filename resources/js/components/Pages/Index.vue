<template>
  <div>
    <Card title="Pages" :footer="pages.data && pages.last_page != 1">
      <template v-slot:toolbar>
        <button
          @click="addPage()"
          type="button"
          data-bs-toggle="modal"
          data-bs-target="#pageModal"
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
              <th class="text-center" width="22%">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(page, index) in pages.data" :key="index">
              <td class="text-center">{{ index +1 }}</td>
              <td>
                <a :href="`/pages/content-manager/${page.slug}`" class="fw-bold">{{ page.title }}</a>
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
                    data-bs-target="#pageModal"
                  >Edit</a>
                  <a
                    :href="`/pages/content-manager/${page.slug}`"
                    class="text-success"
                  >Manage Content</a>
                  <a href="#" @click.prevent="confirmDelete(page)" class="text-danger">Delete</a>
                </span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div v-else>
        <EmptyDataAlert @on-click-add="addPage" target="#pageModal" />
      </div>
      <template v-slot:footer>
        <Pagination :data="pages" @fetch-data="fetchData" />
      </template>
    </Card>

    <!-- Begin::Modal Form  -->
    <form @submit.prevent="onSubmit">
      <Modal :title="action+' Page'" modalId="pageModal">
        <PageForm ref="pageForm" />
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
import Card from "../Base/Card.vue";
import Modal from "../Base/Modal.vue";
import PageForm from "./PageForm.vue";
import Pagination from "../Base/Pagination.vue";
import EmptyDataAlert from "../Base/EmptyDataAlert.vue";
export default {
  name: "PageIndex",
  components: {
    Card,
    Modal,
    PageForm,
    Pagination,
    EmptyDataAlert,
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
    fetchData(url = "/pages/get?page=1") {
      this.$axios
        .get(url)
        .then((response) => {
          this.pages = response.data.data;
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    addPage() {
      this.action = "Add";
      this.$refs.pageForm.clearData();
    },
    editPage(page) {
      this.action = "Edit";
      this.$refs.pageForm.getData(page);
    },
    onSubmit() {
      this.$refs.pageForm.submitData();
    },
    confirmDelete(page) {
      Swal.fire({
        html: `Are you sure you want to delete ${page.title} Page?`,
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
            this.deletePage(page);
          }
        })
        .catch((error) => {
          console.log(error);
        });
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