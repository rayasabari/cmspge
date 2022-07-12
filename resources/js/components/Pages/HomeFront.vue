<template>
  <form @submit.prevent="onSubmit">
    <FormCard title="Home Front" :lastUpdated="data.LastUpdate">
      <div class="row mb-6" v-for="(item, index) in data.text_title" :key="index">
        <label class="col-lg-4 col-form-label fw-semibold fs-6">Text Component {{ index + 1 }}</label>
        <div class="col-lg-8">
          <div class="row mb-4">
            <div class="col-lg-12">
              <input
                type="text"
                class="form-control form-control-lg form-control-solid"
                placeholder="Title"
                required
                @input="replacePipe($event, 'text_title', index)"
                v-model="data.text_title[index]"
              />
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <textarea
                class="form-control form-control-lg form-control-solid"
                placeholder="Description"
                rows="4"
                required
                @input="replacePipe($event, 'text_description', index)"
                v-model="data.text_description[index]"
              ></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-6">
        <label class="col-lg-4 col-form-label fw-semibold fs-6">Youtube Video URL</label>
        <div class="col-lg-8 fw-row">
          <input
            type="text"
            class="form-control form-control-lg form-control-solid"
            placeholder="https://www.youtube.com/watch?v=..."
            v-model="data.youtube"
          />
        </div>
      </div>
    </FormCard>
  </form>
</template>

<script>
import FormCard from "../Base/FormCard.vue";

export default {
  name: "HomeFront",
  components: {
    FormCard,
  },
  data() {
    return {
      data: {
        text_title: [],
        text_description: [],
        LastUpdate: null,
      },
    };
  },
  mounted() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      this.$http.get("/pages/home-front/getdata").then((response) => {
        const res = response.data.data;
        this.data = res;
        this.data.text_title = res.text_title.split("|");
        this.data.text_description = res.text_description.split("|");
      });
    },
    onSubmit() {
      this.$http
        .post("/pages/home-front/savedata", {
          text_title: this.data.text_title.join("|"),
          text_description: this.data.text_description.join("|"),
          youtube: this.data.youtube,
        })
        .then((response) => {
          console.log(response.data);
          this.Notify.success(response.data.message);
          this.fetchData();
        });
    },
    replacePipe(event, key, index) {
      let text = event.target.value;
      this.data[key][index] = text.replace(/\|/g, " ");
    },
  },
};
</script>

<style>
</style>