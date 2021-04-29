<template>
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
      <router-link class="navbar-brand" to="/">Film App</router-link>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="navbar-nav">
          <router-link :to="{name: 'films.index'}" class="nav-item nav-link">Films</router-link>
          <router-link :to="{name: 'films.create'}" class="nav-item nav-link"
            >Create File</router-link
          >
        </div>
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
          <!-- Authentication Links -->

          <li class="nav-item" v-if="!isLoggedIn">
            <router-link class="nav-link" to="/login">Login</router-link>
          </li>

          <li class="nav-item" v-if="!isLoggedIn">
            <router-link class="nav-link" to="/register">Register</router-link>
          </li>

          <li class="nav-item dropdown" v-if="isLoggedIn">
            <a
              id="navbarDropdown"
              class="nav-link dropdown-toggle"
              href="#"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              {{ user.name }}
            </a>

            <div
              class="dropdown-menu dropdown-menu-right"
              aria-labelledby="navbarDropdown"
            >
              <a class="dropdown-item" href="" @click="logout"> Logout </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <router-view />
  </div>
</template>

<script>
import { mapState } from "vuex";

export default {
  computed: {
    ...mapState({
      isLoggedIn: (state) => !!state.auth,
      user: (state) => state.auth,
    }),
  },
  methods: {
    logout() {
      this.$store.dispatch('logout')
    },
  },
};
</script>

<style>
body {
  background: #faff81;
}
</style>