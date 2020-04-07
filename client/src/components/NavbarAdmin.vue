<template>
  <div>
    <!-- HEADER -->
    <nav class="navbar header">
      <div class="nav-item-one">
        <a href="#" class="navbar-brand" @click="home">LendsGames DEMO - {{ user.name }}</a>
      </div>
      <div class="nav-item-two">
        <!-- <a
          href="#"
          class="navbar-brand"
          v-for="filial in filials"
          :key="filial.id"
          @click="changeFilial(filial)"
          v-bind:class="[{ selected: current_selected == filial.id }]"
          >{{ filial.title }}</a
        > -->

        <!-- <font-awesome-icon
          :icon="['fas', 'user-lock']"
          size="lg"
          class="icon"
          @click="openModal"
        /> -->

        <a href="#">Adicionar Jogo</a>
        <a href="#" class="navbar-brand">Editar Perfil</a>
        <a href="#" class="navbar-brand">Sair</a>
      </div>
      <!-- <div class="nav-item-two" v-else>
        



      </div> -->
    </nav>
    <!-- FIM HEADER -->

    <!-- Login Modal -->
    <!-- <login-modal v-model="login_modal_open"></login-modal> -->
  </div>
</template>

<style lang="scss">
@import "../sass/Navbar.scss";
</style>

<script>
import { mapGetters, mapActions } from "vuex";
import EventBus from "../main.js";
import Axios from "axios";

export default {
  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user",
    }),
  },
  data() {
    return {
      filials: [],
      current_selected: 1,
      // login_modal_open: false,
      // logged_in: false,
    };
  },
  created() {
    this.fetchUser();
  },
  methods: {
    ...mapActions({
      signOutAction: "auth/signOut",
    }),

    signOut() {
      this.signOutAction().then(() => {
        this.$router.replace({
          name: "home",
        });
      });
    },
    fetchUser(page_url) {
      let vm = this;

      page_url = page_url || "http://127.0.0.1:8000/api/filials";

      Axios.get(page_url)
        .then((res) => {
          this.filials = res.data;
          vm.changeFilial(this.filials[0]);
        })
        .catch((err) => console.log(err));
    },

    home() {
      EventBus.$emit("home", "");
    },
    // openModal() {
    //   this.login_modal_open = !this.login_modal_open;
    // },
    // changeFilial(filial) {
    //   this.current_selected = filial.id;
    //   EventBus.$emit("changeFilial", filial);
    // },
    // fetchFilials(page_url) {
    //   let vm = this;

    //   page_url = page_url || "http://127.0.0.1:8000/api/filials";

    //   Axios.get(page_url)
    //     .then((res) => {
    //       this.filials = res.data;
    //       vm.changeFilial(this.filials[0]);
    //     })
    //     .catch((err) => console.log(err));
    // },
  },
};
</script>
