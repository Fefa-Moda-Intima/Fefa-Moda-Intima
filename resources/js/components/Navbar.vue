<script>
import { mapGetters } from "vuex";
import LocaleDropdown from "./LocaleDropdown";
import Vue from "vue";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

Vue.use(Toast, {
  // top-right, top-center, top-left, bottom-right, bottom-center, bottom-left.
  position: "top-right",
  // place newest toast on the top
  newestOnTop: true,
  // the max number of toasts
  maxToasts: 20,
  // name of the Vue Transition or object with classes to use
  // only enter-active, leave-active and move are applied.
  transition: "Vue-Toastification__bounce",
  // duration in ms
  // or an object: {enter: Number, leave: Number}
  transitionDuration: 350,
  // allows to dismiss by drag & swipe events
  draggable: true,
  draggablePercent: 0.6,
  // auto pause when out of focus
  pauseOnFocusLoss: true,
  // auto pause on hover
  pauseOnHover: true,
  // close on click
  closeOnClick: true,
  // auto dismiss after this timeout
  timeout: 2000,
  // container element
  container: document.body,
  // custom classes
  toastClassName: [],
  // body classes
  bodyClassName: [],
  // show/hide the progress bar
  hideProgressBar: false,
  // show/hide the close button
  hideCloseButton: false,
  // custom icons here
  icon: true
});

export default {
  components: {
    LocaleDropdown
  },

  data: () => ({
    appName: window.config.appName
  }),

  computed: mapGetters({
    user: "auth/user"
  }),

  methods: {
    async logout() {
      // Log out the user.
      await this.$store.dispatch("auth/logout");

      // Redirect to login.
      this.$router.push({ name: "login" });
    }
  }
};
</script>

<style scoped>
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -0.375rem 0;
}

.container {
  max-width: 1100px;
}
</style>

<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
      <router-link
        :to="{ name: user ? 'home' : 'welcome' }"
        class="navbar-brand"
      >
        {{ appName }}
      </router-link>

      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbar"
      >
        <span class="navbar-toggler-icon" />
      </button>

      <div id="navbar" class="collapse navbar-collapse">
        <ul class="navbar-nav">
          <locale-dropdown />
          <!-- <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li> -->
          <a class="nav-link text-dark" href="/tests" role="button">
            Testes
          </a>
        </ul>

        <ul class="navbar-nav ms-auto">
          <!-- Authenticated -->
          <li v-if="user" class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle text-dark"
              href="#"
              role="button"
              data-bs-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <img
                :src="user.photo_url"
                class="rounded-circle profile-photo me-1"
              />
              {{ user.name }}
            </a>
            <div class="dropdown-menu">
              <router-link
                :to="{ name: 'settings.profile' }"
                class="dropdown-item ps-3"
              >
                <fa icon="cog" fixed-width />
                {{ $t("settings") }}
              </router-link>

              <div class="dropdown-divider" />
              <a href="#" class="dropdown-item ps-3" @click.prevent="logout">
                <fa icon="sign-out-alt" fixed-width />
                {{ $t("logout") }}
              </a>
            </div>
          </li>
          <!-- Guest -->
          <template v-else>
            <li class="nav-item">
              <router-link
                :to="{ name: 'login' }"
                class="nav-link"
                active-class="active"
              >
                {{ $t("login") }}
              </router-link>
            </li>
            <li class="nav-item">
              <router-link
                :to="{ name: 'register' }"
                class="nav-link"
                active-class="active"
              >
                {{ $t("register") }}
              </router-link>
            </li>
          </template>
        </ul>
      </div>
    </div>
  </nav>
</template>
