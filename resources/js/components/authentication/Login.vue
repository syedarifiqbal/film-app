<template>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Login to system</div>

        <div class="card-body">
          <form @submit.prevent="login">

            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right"
                >E-Mail Address</label
              >

              <div class="col-md-6">
                <input
                  id="email"
                  type="email"
                  class="form-control"
                  name="email"
                  v-model="form.email"
                  autocomplete="email"
                />

                <p class="text-danger mb-0" v-if="errors && errors.email">
                  {{ errors.email[0] }}
                </p>
              </div>
            </div>

            <div class="form-group row">
              <label
                for="password"
                class="col-md-4 col-form-label text-md-right"
                >Password</label
              >

              <div class="col-md-6">
                <input
                  id="password"
                  type="password"
                  class="form-control"
                  name="password"
                  v-model="form.password"
                  autocomplete="new-password"
                />
                <p class="text-danger mb-0" v-if="errors && errors.password">
                  {{ errors.password[0] }}
                </p>
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">Login</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
export default {
  data() {
    return {
      form: {
        email: "",
        password: "",
      },
    };
  },
  computed: {
    ...mapState({
      errors: (state) => state.errors,
    }),
  },
  methods: {
    async login() {

      this.$store
        .dispatch("login", this.form)
        .then(() => {
          this.$router.push({ name: "films.index" });
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>
