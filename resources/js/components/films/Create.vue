<template>
  <div class="container mt-4">
    <div class="row justify-content-center">
      <div class="col-md-6 justify-content-center">
        <div class="card">
          <form class="card-body" @submit.prevent="saveFilm">
            <div>
              <div class="d-flex justify-content-center position-relative">
                <img :src="based64Image" alt="" class="image" />
                <label for="imagepicker" class="fa fa-camera"></label>
                <input
                  type="file"
                  class="d-none"
                  id="imagepicker"
                  @change="pickedFile"
                />
              </div>
            <p class="text-danger" v-if="errors && !!errors.photo_binary.length">
              {{ errors.photo_binary[0] }}
            </p>
            </div>

            <input
              type="text"
              class="form-control mt-3"
              v-model="films.name"
              placeholder="Film name"
            />
            <p class="text-danger" v-if="errors && !!errors.name.length">
              {{ errors.name[0] }}
            </p>

            <textarea
              class="form-control mt-3"
              v-model="films.description"
              placeholder="Film Description"
            ></textarea>
            <p class="text-danger" v-if="errors && !!errors.description.length">
              {{ errors.description[0] }}
            </p>

            <input
              type="date"
              class="form-control mt-3"
              v-model="films.release_date"
            />
            <p class="text-danger" v-if="errors && !!errors.release_date.length">
              {{ errors.release_date[0] }}
            </p>

            <input
              type="number"
              class="form-control mt-3"
              v-model="films.ticket_price"
              placeholder="Ticket Price"
            />
            <p class="text-danger" v-if="errors && !!errors.ticket_price.length">
              {{ errors.ticket_price[0] }}
            </p>

            <input
              type="number"
              min="1"
              max="5"
              class="form-control mt-3"
              v-model="films.rating"
              placeholder="Rating"
            />
            <p class="text-danger" v-if="errors && !!errors.rating.length">
              {{ errors.rating[0] }}
            </p>

            <p class="text-muted">
              To keep things simple i am just puting input here and storing the
              rating as a average number.
            </p>

            <input
              type="text"
              class="form-control mt-3"
              v-model="films.country"
              placeholder="Country"
            />
            <p class="text-danger" v-if="errors && !!errors.country.length">
              {{ errors.country[0] }}
            </p>

            <tags-input
              element-id="tags"
              v-model="films.gerne"
              :add-tags-on-comma="false"
              placeholder="Add Genre"
            ></tags-input>

            <p class="text-muted">
              To keep things simple i am just puting input here and storing the
              genre as a json in database, However it's better to have in
              relations (one to many or many to many).
            </p>
            <p class="text-danger" v-if="errors && !!errors.gerne.length">
              {{ errors.gerne[0] }}
            </p>

            <button type="submit" class="btn btn-primary mt-3" v-text="isEdit? 'Update': 'Create'"></button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VoerroTagsInput from "@voerro/vue-tagsinput";
export default {
  components: { "tags-input": VoerroTagsInput },
  watch: {
    "$route.params.slug": {
      deep: true,
      immediate: true,
      handler: function () {
        this.slug = this.$route.params.slug;
        this.loadFilm();
      },
    },
  },
  data() {
    return {
      slug: undefined,
      errors: undefined,
      films: undefined,
      based64Image:
        "https://davidkoepp.com/wp-content/themes/blankslate/images/Movie%20Placeholder.jpg",
    };
  },
  computed: {
    isEdit(){
      return !!this.slug;
    }
  },
  methods: {
    async saveFilm() {
      try {
        await this.axios.post(`/films`, this.prepareFormData());
        this.$router.push({ name: "films.index" });
      } catch (error) {
        console.log(error.response.data.errors);
        this.errors = error.response.data.errors;
      }
    },
    prepareFormData() {
      const fd = new FormData();
      for (const key in this.films) {
        if (Object.hasOwnProperty.call(this.films, key)) {
          const value = this.films[key];

          if (Array.isArray(value)) {
            if (key === "gerne") {
              value.forEach((x) => fd.append(`${key}[]`, x.value));
            }else{
              value.forEach((x) => fd.append(`${key}[]`, x));
            }
          } else {
            fd.append(key, value);
          }
        }
      }
      return fd;
    },
    pickedFile(e) {
      const file = e.target.files[0];
      const reader = new FileReader();
      const that = this;
      reader.addEventListener(
        "load",
        function () {
          that.based64Image = reader.result;
        },
        false
      );

      if (file) {
        reader.readAsDataURL(file);
        this.films.photo_binary = file;
      }
    },
    async loadFilm() {

      this.films = {
        name: "",
        description: "",
        photo_binary: undefined,
        ticket_price: "",
        gerne: [],
        release_date: "",
        country: "",
      };

      this.based64Image = "https://davidkoepp.com/wp-content/themes/blankslate/images/Movie%20Placeholder.jpg";

      if (!this.slug) return;
      const { data } = await this.axios.get(`/films/${this.slug}`);
      data.gerne = data.gerne.map( g => ({ key: "", value: g }))
      this.films = data;
      this.based64Image = data.photo;
    },
  },
};
</script>

<style lang=scss>
.image {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  box-shadow: 0 0 15px -5px;
}
label.fa.fa-camera {
  background: white;
  width: 25px;
  height: 25px;
  box-shadow: 0 0 10px -2px;
  border-radius: 50%;
  text-align: center;
  line-height: 25px;
  color: #000048;
  position: absolute;
  bottom: 0px;
}
.tags-input-wrapper-default.tags-input input {
  margin-top: 1rem;
  display: block;
  width: 100%;
  height: calc(1.6em + 0.75rem + 2px);
  padding: 0.375rem 0.75rem;
  font-size: 0.9rem;
  font-weight: 400;
  line-height: 1.6;
  color: #495057;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
span.tags-input-badge {
  margin-top: 1rem;
  display: inline-block;
  background: #ccc;
  padding: 2px 10px;
  border-radius: 5px;
  margin-left: 10px;
}

span.tags-input-badge:first-child {
  margin-left: 0;
}
</style>

