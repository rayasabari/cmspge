<template>
  <div class="table-responsive">
    <table class="table table-hover table-row-bordered">
      <thead>
        <tr class="fw-bold fs-6 text-gray-800">
          <th>Type</th>
          <th>Title</th>
          <th>Text</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(content, index) in contents" :key="index">
          <td>{{ content.element.name }}</td>
          <td>{{ content.title }}</td>
          <td>{{ content.text }}</td>
          <td class="text-center">
            <span class="d-flex justify-content-center gap-4 fw-bold">
              <a
                href="#"
                @click.prevent="$parent.$parent.editContent(content)"
                class="text-primary"
                data-bs-toggle="modal"
                data-bs-target="#contentModal"
              >Edit</a>
              <a
                href="#"
                @click.prevent="$parent.$parent.confirmDelete(content)"
                class="text-danger"
              >Delete</a>
            </span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: "Contents",
  props: ["contents"],
};
</script>

<style>
</style>