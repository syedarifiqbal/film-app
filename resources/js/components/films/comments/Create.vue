<template>
  <li class="list-group-item">
    <form @submit.prevent="save">
      <textarea
        name="body"
        v-model="comment.body"
        class="form-control"
        placeholder="Write your comment here..."
      ></textarea>
      <button type="submit" class="mt-4 btn btn-primary">Post</button>
    </form>
  </li>
</template>

<script>
export default {
  props: {
    filmId: {
      type: Number,
      require: true,
    },
  },
  data() {
    return {
      comment: {
        body: "",
      },
    };
  },
  methods: {
    async save() {
      const { data } = await this.axios.post(`/films/${this.filmId}/comments`, this.comment);
      this.$emit("onComment", data);
      this.comment.body = "";
    },
  },
};
</script>

<style lang=scss>
li.page-mover {
  background: white;
  padding: 5px 15px;
  box-shadow: 0px 5px 43px rgb(0 0 0 / 48%);
  font-weight: bold;
}
</style>

