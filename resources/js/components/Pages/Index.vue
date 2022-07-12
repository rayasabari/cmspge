<template>
  <Card title="Page Index" :footer="pages.last_page != 1">
    <template v-slot:toolbar>
      <a href="/pages/add" class="btn btn-sm btn-primary">Add New</a>
    </template>
    <div v-if="pages.total > 0" class="table-responsive">
      <table class="table table-hover table-row-bordered">
        <thead>
          <tr class="fw-bold fs-6 text-gray-800">
            <th>Title</th>
            <th>Author</th>
            <th>Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(page, index) in pages.data" :key="index">
            <td>{{ page.title }}</td>
            <td>{{ page.created_by_id }}</td>
            <td>{{ page.created_at }}</td>
            <td>
              <a :href="'/pages/edit/'+page.id" class="btn btn-sm btn-primary">Edit</a>
              <a :href="'/pages/delete/'+page.id" class="btn btn-sm btn-danger">Delete</a>
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
</template>

<script>
import Card from "../Base/Card.vue";
import Alert from "../Base/Alert.vue";
export default {
  name: "PageIndex",
  components: {
    Card,
    Alert,
  },
  data() {
    return {
      title: "Page Index",
      pages: {},
    };
  },
  mounted() {
    this.fetchData();
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
  },
};
</script>

<style>
</style>