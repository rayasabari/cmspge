<template>
  <div>
    <Card title="media" :footer="media.data && media.last_page != 1">
      <template v-slot:toolbar>
        <button
          @click="addMedia()"
          type="button"
          data-bs-toggle="modal"
          data-bs-target="#mediaModal"
          class="btn btn-sm btn-primary"
        >Add New</button>
      </template>
      <div v-if="media.total > 0" class="table-responsive">
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
            <tr v-for="(media, index) in media.data" :key="index">
              <td class="text-center">{{ index +1 }}</td>
              <td>
                <a :href="`/media/content-manager/${media.slug}`" class="fw-bold">{{ media.title }}</a>
              </td>
              <td class="text-center">{{ media.user.first_name }}</td>
              <td class="text-center text-muted">{{ media.Created }}</td>
              <td class="text-center">
                <span class="d-flex justify-content-center gap-4 fw-bold">
                  <a
                    href="#"
                    @click.prevent="editMedia(media)"
                    class="text-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#mediaModal"
                  >Edit</a>
                  <a
                    :href="`/media/content-manager/${media.slug}`"
                    class="text-success"
                  >Manage Content</a>
                  <a href="#" @click.prevent="confirmDelete(media)" class="text-danger">Delete</a>
                </span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div v-else>
        <EmptyDataAlert @on-click-add="addmedia" target="#mediaModal" />
      </div>
      <template v-slot:footer>
        <Pagination :data="media" @fetch-data="fetchData" />
      </template>
    </Card>

    <!-- Begin::Modal Form  -->
    <form @submit.prevent="onSubmit">
      <Modal :title="action+' media'" modalId="mediaModal">
        <Form ref="mediaForm" />
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
import Form from "./Form.vue";
import Pagination from "../Base/Pagination.vue";
import EmptyDataAlert from "../Base/EmptyDataAlert.vue";
export default {
  name: "mediaIndex",
  components: {
    Card,
    Modal,
    Form,
    Pagination,
    EmptyDataAlert,
  },
  data() {
    return {
      title: "media Index",
      media: {},
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
    fetchData(url = "/media/get?media=1") {
      this.$axios
        .get(url)
        .then((response) => {
          this.media = response.data.data;
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    addMedia() {
      this.action = "Add";
      this.$refs.mediaForm.clearData();
    },
    editMedia(media) {
      this.action = "Edit";
      this.$refs.mediaForm.getData(media);
    },
    onSubmit() {
      this.$refs.mediaForm.submitData();
    },
    confirmDelete(media) {
      Swal.fire({
        html: `Are you sure you want to delete ${media.title} media?`,
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
            this.deleteMedia(media);
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    deleteMedia(media) {
      this.$axios
        .delete(`/media/delete/${media.id}`)
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