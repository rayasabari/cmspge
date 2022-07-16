<template>
  <div class="row">
    <div class="col-lg-4">
      <Card title="Elements">
        <ElementType :elements="elementType" />
      </Card>
    </div>
    <div class="col-lg-8">
      <Card :title="page.title+' Page Content'">
        <ElementList :elements="page.elements" />
      </Card>
    </div>
    <Modal :title="modalTitle" modalId="elementModal">
      <ElementForm ref="elementForm" />
      <template v-slot:footer>
        <button type="button" ref="closeModal" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
      </template>
    </Modal>
  </div>
</template>

<script>
import Card from "../Base/Card.vue";
import Modal from "../Base/Modal.vue";
import ElementType from "./ElementType.vue";
import ElementList from "./ElementList.vue";
import ElementForm from "./ElementForm.vue";
export default {
  name: "ContentManager",
  components: {
    Card,
    Modal,
    ElementType,
    ElementList,
    ElementForm,
  },
  props: ["id"],
  data() {
    return {
      page: {},
      elementType: [],
      action: '',
      modalTitle: ''
    };
  },
  mounted() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      this.$axios
        .get("/pages/content-manager/get/data/" + this.id)
        .then((response) => {
          this.page = response.data.data.page;
          this.elementType = response.data.data.elementType;
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    addElement(element) {
      this.action = "Add";
      this.modalTitle = this.action + " " + element.name;
      this.$refs.elementForm.clearData();
    },
  },
};
</script>

<style>
</style>