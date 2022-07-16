<template>
  <div class="table-responsive">
    <table class="table table-hover table-row-bordered">
      <thead>
        <tr class="fw-bold fs-6 text-gray-800">
          <th>Type</th>
          <th>Title</th>
          <th class="text-center">Text</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(element, index) in elements" :key="index">
          <td>{{ element.type.name }}</td>
          <td>
            {{ element.title }}
          </td>
          <td class="text-center">{{ element.text }}</td>
          <td class="text-center">
            <span class="d-flex justify-content-center gap-4 fw-bold">
              <a
                href="#"
                class="text-primary"
                data-bs-toggle="modal"
                data-bs-target="#kt_modal_1"
              >Edit</a>
              <a href="#" @click.prevent="confirmDelete(page)" class="text-danger">Delete</a>
            </span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: "ElementsList",
  props: ["elements"],
};
</script>

<style>
</style>