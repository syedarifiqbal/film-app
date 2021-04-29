<template>
  <div class="container mt-4">
    <div class="row justify-content-center" v-if="films && films.data.length > 0">
      <div class="col-md-12 justify-content-center d-flex">
        <card v-for="film in films.data" :key="film.id" :film="film"></card>
      </div>
      <div class="col-lg-12">
        <paginate
          v-if="films && films.total>0"
          :page-count="films.last_page"
          :click-handler="loadFilms"
          :prev-text="'Previous'"
          :next-text="'Next'"
          page-class="d-none"
          prev-class="page-mover"
          next-class="page-mover"
          container-class="pagination justify-content-around mt-5"
        >
        </paginate>
      </div>
    </div>
    <div class="row justify-content-center" v-else>
      <div class="col-md-12 justify-content-center d-flex">
        <p>No films available.</p>
      </div>
    </div>
  </div>
</template>

<script>
import Paginate from "vuejs-paginate";
import Card from "./Card";

export default {
  components: { Paginate, Card },
  data() {
    return {
      films: undefined,
    };
  },
  mounted() {
    this.loadFilms();
  },
  methods: {
    async loadFilms(page = 1) {
      const { data } = await this.axios.get(`/films?page=${page}`);
      this.films = data;
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

