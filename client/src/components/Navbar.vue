<template>
  <div>
    <!-- HEADER -->
    <nav class="navbar header">
      <div class="nav-item-one">
        <a href="#" class="navbar-brand" @click="home">LendsGames DEMO</a>
      </div>
      <div class="nav-item-two">
        <a
          href="#"
          class="navbar-brand"
          v-for="filial in filials"
          :key="filial.id"
          @click="changeFilial(filial)"
          v-bind:class="[{ selected: current_selected == filial.id }]"
          >{{ filial.title }}</a
        >

        <font-awesome-icon
          :icon="['fas', 'user-lock']"
          size="lg"
          class="icon"
          @click="openModal"
        />
      </div>
    </nav>
    <!-- FIM HEADER -->

    <!-- Login Modal -->
    <login-modal v-model="login_modal_open"></login-modal>
  </div>
</template>

<style lang="scss">
@import "../sass/Navbar.scss";
</style>

<script>
import EventBus from "../main.js";
import Axios from "axios";

export default {
  data() {
    return {
      user: [],
      filials: [],
      current_selected: 1,
      login_modal_open: false,
      logged_in: false,
    };
  },
  created() {
    this.fetchFilials();
  },
  methods: {
    home() {
      EventBus.$emit("home", "");
    },
    openModal() {
      this.login_modal_open = !this.login_modal_open;
    },
    changeFilial(filial) {
      this.current_selected = filial.id;
      EventBus.$emit("changeFilial", filial);
    },
    fetchFilials(page_url) {
      let vm = this;

      page_url = page_url || "filials/all";

      Axios.get(page_url)
        .then((res) => {
          this.filials = res.data;
          vm.changeFilial(this.filials[0]);
        })
        .catch((err) => console.log(err));
    },
  },
};
</script>
