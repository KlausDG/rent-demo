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
            <b-dropdown-item @click="openModal('addGame', modal.addGame)">Jogo</b-dropdown-item>
            <b-dropdown-item @click="openModal('addDifficulty', modal.addDifficulty)">Dificuldade</b-dropdown-item>
            <b-dropdown-item @click="openModal('addGenre', modal.addGenre)">Gênero</b-dropdown-item>
            <b-dropdown-item @click="openModal('addLanguage', modal.addLanguage)">Idioma</b-dropdown-item>
            <b-dropdown-item @click="openModal('addFilial', modal.addFilial)">Filial</b-dropdown-item>
            <b-dropdown-item @click="openModal('addUser', modal.addUser)">Sócio</b-dropdown-item>
          </b-nav-item-dropdown>

          <b-nav-item-dropdown
            id="my-nav-dropdown"
            class="custom-dropdown"
            text="Editar"
            toggle-class="nav-link-custom"
            left
          >
            <!-- <b-dropdown-item @click="openEditProfileModal">Perfil (to-do)</b-dropdown-item> -->
            <b-dropdown-item @click="openModal('editProfile', modal.editProfile)">Perfil</b-dropdown-item>
            <b-dropdown-item @click="openModal('editDifficulties', modal.editDifficulties)">Dificuldades (to-do)</b-dropdown-item>
            <b-dropdown-item>Gêneros (to-do)</b-dropdown-item>
            <b-dropdown-item>Idiomas (to-do)</b-dropdown-item>
            <b-dropdown-item>Filiais (to-do)</b-dropdown-item>
            <b-dropdown-item>Sócios (to-do)</b-dropdown-item>
          </b-nav-item-dropdown>
        </b-nav>

        <!-- <a href="#" class="navbar-brand" @click="openModal"> Adicionar Jogo </a> -->
        <!-- <a href="#" class="navbar-brand"> Editar Perfil </a>
        <a href="#" class="navbar-brand"> Editar Filial </a> -->
        <a href="#" class="navbar-brand" @click="logout"> Sair </a>
      </div>
    </nav>
    <!-- FIM HEADER -->

    <!-- ADD MODAL -->
    <add-game-modal v-model="modal.addGame"></add-game-modal>
    <add-genre-modal v-model="modal.addGenre"></add-genre-modal>
    <add-difficulty-modal v-model="modal.addDifficulty"></add-difficulty-modal>
    <add-language-modal v-model="modal.addLanguage"></add-language-modal>
    <add-filial-modal v-model="modal.addFilial"></add-filial-modal>
    <add-socio-modal v-model="modal.addUser"></add-socio-modal>

    <!-- EDIT MODAL -->
    <edit-profile-modal v-model="modal.editProfile"></edit-profile-modal>
    <edit-difficulties-modal v-model="modal.editDifficulties"></edit-difficulties-modal>
  </div>
</template>

<style lang="scss">
@import "../sass/Navbar.scss";
</style>

<script>
import EventBus from "../main.js";
import { mapGetters, mapActions } from "vuex";

export default {
  data() {
    return {
      modal: {
        addGame: false,
        addGenre: false,
        addDifficulty: false,
        addLanguage: false,
        addFilial: false,
        addUser: false,
        editProfile: false,
        editDifficulties: false,
      },
    };
  },

  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user",
    }),
  },

  methods: {
    ...mapActions({
      signOutAction: "auth/signOut",
    }),

    home() {
      EventBus.$emit("home", "");
    },

    logout() {
      this.signOutAction().then(() => {
        this.$router.replace({
          name: "games",
        });
      });
    },

    openModal(property, value) {
      this.modal[property] = !value;
    },
  },
};
</script>
