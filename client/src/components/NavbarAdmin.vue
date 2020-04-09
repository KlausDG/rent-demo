<template>
  <div>
    <!-- HEADER -->
    <nav class="navbar header">
      <div class="nav-item-one">
        <a href="#" class="navbar-brand" @click="home"
          >Admin - {{ user.name }}</a
        >
      </div>
      <div class="nav-item-two">
        <b-nav>
          <b-nav-item-dropdown
            id="my-nav-dropdown"
            class="custom-dropdown"
            text="Cadastrar"
            toggle-class="nav-link-custom"
            left
          >
            <b-dropdown-item @click="openGameModal">Jogo</b-dropdown-item>
            <b-dropdown-item @click="openDifficultyModal">Dificuldade</b-dropdown-item>
            <b-dropdown-item @click="openGenreModal">Gênero</b-dropdown-item>
            <b-dropdown-item @click="openLanguageModal">Idioma</b-dropdown-item>
          </b-nav-item-dropdown>

          <b-nav-item-dropdown
            id="my-nav-dropdown"
            class="custom-dropdown"
            text="Editar"
            toggle-class="nav-link-custom"
            left
          >
            <b-dropdown-item>Perfil</b-dropdown-item>
            <b-dropdown-item>Filial</b-dropdown-item>
          </b-nav-item-dropdown>
        </b-nav>

        <!-- <a href="#" class="navbar-brand" @click="openModal"> Adicionar Jogo </a> -->
        <!-- <a href="#" class="navbar-brand"> Editar Perfil </a>
        <a href="#" class="navbar-brand"> Editar Filial </a> -->
        <a href="#" class="navbar-brand"> Sair </a>
      </div>
    </nav>
    <!-- FIM HEADER -->

    <!-- ADD GAME MODAL -->
    <add-game-modal v-model="add_game_modal_open"></add-game-modal>
    <add-genre-modal v-model="add_genre_modal_open"></add-genre-modal>
    <add-difficulty-modal
      v-model="add_difficulty_modal_open"
    ></add-difficulty-modal>
    <add-language-modal v-model="add_language_modal_open"></add-language-modal>
  </div>
</template>

<style lang="scss">
@import "../sass/Navbar.scss";
</style>

<script>
import EventBus from "../main.js";
import { mapGetters } from "vuex";

export default {
  data() {
    return {
      add_game_modal_open: false,
      add_genre_modal_open: false,
      add_difficulty_modal_open: false,
      add_language_modal_open: false,
    };
  },

  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user",
    }),
  },

  methods: {
    home() {
      EventBus.$emit("home", "");
    },
    openGameModal() {
      this.add_game_modal_open = !this.add_game_modal_open;
    },
    openGenreModal() {
      this.add_genre_modal_open = !this.add_genre_modal_open;
    },
    openDifficultyModal() {
      this.add_difficulty_modal_open = !this.add_difficulty_modal_open;
    },
    openLanguageModal() {
      this.add_language_modal_open = !this.add_language_modal_open;
    },
  },
};
</script>
