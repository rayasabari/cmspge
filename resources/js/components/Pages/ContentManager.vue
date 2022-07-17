<template>
  <div class="row">
    <div class="col-lg-3">
      <Card title="Elements">
        <Elements :elements="elements" />
      </Card>
    </div>
    <div class="col-lg-9">
      <Card :title="page.title+' Page Content'">
        <Contents :contents="page.contents" />
      </Card>
    </div>
    <form @submit.prevent="onSubmit">
      <Modal :title="modalTitle" modalId="contentModal">
        <ContentForm ref="contnntForm" />
        <template v-slot:footer>
          <button type="button" ref="closeModal" class="btn btn-light" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-sm">Submit</button>
        </template>
      </Modal>
    </form>
  </div>
</template>

<script>
import Card from "../Base/Card.vue";
import Modal from "../Base/Modal.vue";
import Elements from "./Elements.vue";
import Contents from "./Contents.vue";
import ContentForm from "./ContentForm.vue";
export default {
  name: "ContentManager",
  components: {
    Card,
    Modal,
    Elements,
    Contents,
    ContentForm,
  },
  props: ["slug"],
  data() {
    return {
      page: {},
      elements: [],
      action: "",
      modalTitle: "",
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
        .get("/pages/content-manager/getdata/" + this.slug)
        .then((response) => {
          this.page = response.data.data.page;
          this.elements = response.data.data.elements;
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    addContent(element) {
      this.action = "Add";
      this.modalTitle = this.action + " " + element.name;
      this.$refs.contnntForm.clearData(this.page.id, element.id);
    },
    editContent(element) {
      this.action = "Edit";
      this.modalTitle = this.action + " " + element.element.name;
      this.$refs.contnntForm.getData(element);
    },
    onSubmit() {
      this.$refs.contnntForm.submitData();
    },
    confirmDelete(content) {
      this.Confirm.show(
        "Confirmation",
        `Are you sure you want to delete ${ content.element.name}?`,
        "Yes",
        "No",
        () => {
          this.deleteContent(content);
        },
        () => {}
      );
    },
    deleteContent(content) {
      this.$axios
        .delete(`/pages/content-manager/delete/${content.id}`)
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