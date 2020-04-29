<template>
  <!-- HEADER -->
  <nav class="nav-container">
    <div class="title-container">
      <a href="#" class="title-text" @click="home">Rent-Games DEMO</a>
    </div>
    <div class="menu-container">
      <a
        href="#"
        class="menu-item"
        v-for="filial in filials"
        :key="filial.id"
        @click="changeFilial(filial)"
        v-bind:class="[{ selected: current_selected == filial.id }]"
        >{{ filial.title }}</a
      >

      <font-awesome-icon
        :icon="['fas', 'user-lock']"
        size="lg"
        class="icon-link menu-item"
        @click="openModal"
      />
    </div>
    <!-- Login Modal -->
    <login-modal v-model="login_modal_open"></login-modal>
  </nav>
  <!-- FIM HEADER -->
</template>

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
