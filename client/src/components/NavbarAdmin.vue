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
            <b-dropdown-item @click="openModal('editDifficulties', modal.editDifficulties)">Dificuldades</b-dropdown-item>
            <b-dropdown-item @click="openModal('editGenres', modal.editGenres)">Gêneros</b-dropdown-item>
            <b-dropdown-item @click="openModal('editLanguages', modal.editLanguages)">Idiomas</b-dropdown-item>
            <b-dropdown-item @click="openModal('allFilials', modal.allFilials)">Filiais</b-dropdown-item>
            <b-dropdown-item @click="openModal('allUsers', modal.allUsers)"> Sócios</b-dropdown-item>
          </b-nav-item-dropdown>
        </b-nav>

        <a href="#" class="navbar-brand" @click="logout"> Sair </a>
      </div>
    </nav>
    <!-- FIM HEADER -->

    <!-- ADD MODAL -->
    <add-game-modal v-model="modal.addGame"></add-game-modal>
    <add-filial-modal v-model="modal.addFilial"></add-filial-modal>
    <add-user-modal v-model="modal.addUser"></add-user-modal>

    <!-- EDIT MODAL -->
    <edit-profile-modal v-model="modal.editProfile"></edit-profile-modal>
    <edit-difficulties-modal v-model="modal.editDifficulties"></edit-difficulties-modal>
    <edit-genres-modal v-model="modal.editGenres"></edit-genres-modal>
    <edit-languages-modal v-model="modal.editLanguages"></edit-languages-modal>
    <all-filials-modal v-model="modal.allFilials" v-on:addFilial="openModal('addFilial', modal.addFilial)"></all-filials-modal>
    <all-users-modal v-model="modal.allUsers" v-on:addUser="openModal('addUser', modal.addUser)"></all-users-modal>
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
        addFilial: false,
        addUser: false,
        editProfile: false,
        editDifficulties: false,
        editGenres: false,
        editLanguages: false,
        allFilials: false,
        allUsers: false,
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
