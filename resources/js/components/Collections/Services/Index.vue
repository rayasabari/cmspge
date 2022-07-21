<template>
  <div>
    <Card title="Services" :footer="services.last_page != 1">
      <div v-if="services.total > 0" class="table-responsive">
        <table class="table table-hover table-row-bordered">
          <thead>
            <tr class="fw-bold fs-6 text-gray-800">
              <th class="text-center">#</th>
              <th>Name</th>
              <th class="text-center">Descriptions</th>
              <th class="text-center">Date</th>
              <th class="text-center" width="22%">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(service, index) in services.data" :key="index">
              <td class="text-center">{{ index +1 }}</td>
              <td>{{ service.name }}</td>
              <td class="text-center">{{ service.descriptions }}</td>
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
      <template v-slot:footer>
        <Pagination :data="services" @fetch-data="fetchData" />
      </template>
    </Card>
  </div>
</template>

<script>
import Card from "../../Base/Card.vue";
import Pagination from "../../Base/Pagination.vue";
export default {
  name: "Services",
  components: {
    Card,
    Pagination
  },
  data() {
    return {
      services: [],
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
  },
};
</script>

<style>
</style>