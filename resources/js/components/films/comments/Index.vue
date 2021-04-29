<template>
  <div class="container mt-4">
      <h1>Comments</h1>
    <div class="row justify-content-center pb-5">
      <div class="col-md-12 justify-content-center d-flex" v-if="comments">
        
        <ul class="list-group">
            <li class="list-group-item" v-for="comment in comments.data" :key=comment.id>
              <p class="font-bold" v-text="comment.name"></p>
              <p v-text="comment.body"></p>
            </li>
            <create v-if="isLoggedIn" :filmId="filmId" @onComment="comments.data.push($event)"/>
            <router-link to='/login' v-else class="mt-5">Please login to post your comment.</router-link>
        </ul>

      </div>

      <div class="col-lg-12">
        <button type="button" @click="loadMore" class="btn btn-info mt-5" v-if="comments && comments.next_page_url">Load More Comments...</button>
      </div>
    </div>
  </div>
</template>

<script>
import Create from './Create'
import { mapState } from 'vuex'

export default {
  props: {
    filmId: {
      type: Number,
      require: true,
    },
  },
  components: { Create },
  computed: {
    ...mapState({
      isLoggedIn: (state) => !!state.auth,
    }),
  },
  data() {
    return {
      comments: undefined,
    };
  },
  mounted() {
    this.loadComments();
  },
  methods: {
    async loadComments(page = 1) {
      const { data } = await this.axios.get(`/films/${this.filmId}/comments?page=${page}`);
      this.comments = data;
    },
    async loadMore() {
      const { data } = await this.axios.get(`/films/${this.filmId}/comments?page=${this.comments.current_page+1}`);
      this.comments = { ...data, data: [...this.comments.data, ...data.data] };
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

