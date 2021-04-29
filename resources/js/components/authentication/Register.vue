<template>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Register</div>

        <div class="card-body">
          <form @submit.prevent="register">
            <div class="form-group row">
              <label for="name" class="col-md-4 col-form-label text-md-right"
                >Name</label
              >

              <div class="col-md-6">
                <input
                  id="name"
                  type="text"
                  class="form-control"
                  name="name"
                  v-model="form.name"
                  autocomplete="name"
                  autofocus
                />

                <p class="text-danger mb-0" v-if="errors && errors.name">
                  {{ errors.name[0] }}
                </p>
              </div>
            </div>

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

            <div class="form-group row">
              <label
                for="password-confirm"
                class="col-md-4 col-form-label text-md-right"
                >Confirm Password</label
              >

              <div class="col-md-6">
                <input
                  id="password-confirm"
                  type="password"
                  class="form-control"
                  name="password_confirmation"
                  v-model="form.password_confirmation"
                  autocomplete="new-password"
                />
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">Register</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  data() {
    return {
      form: {
        name: "",
        email: "",
        password: undefined,
        password_confirmation: "",
      },
    };
  },
  computed: {
    ...mapGetters(["errors"]),
  },
  methods: {
    async register() {
      this.$store
        .dispatch("register", this.form)
        .then(() => {
          this.$router.push({ name: "films.index" });
          location.reload();
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>
