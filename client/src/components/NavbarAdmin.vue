<template>
  <div>
    <!-- HEADER -->
    <nav class="nav-container">
      <div class="title-container">
        <a href="#" class="title-text-admin" @click="home">Admin - {{ user.name }}</a>
      </div>

      <div class="menu-container">
        <div class="dropdown">
          <div class="dropdown-label menu-item">Cadastrar</div>
          <div class="dropdown-content">
            <a @click="openModal('addGame', modal.addGame)">Jogo</a>
            <a @click="openModal('addFilial', modal.addFilial)">Loja</a>
            <a @click="openModal('addUser', modal.addUser)">Usuário</a>
          </div>
        </div>

        <div class="dropdown">
          <div class="dropdown-label menu-item">Editar</div>
          <div class="dropdown-content">
            <a @click="openModal('editProfile', modal.editProfile)"
              >Alterar Senha</a
            >
            <a @click="openModal('editDifficulties', modal.editDifficulties)"
              >Dificuldades</a
            >
            <a @click="openModal('editGenres', modal.editGenres)">Gêneros</a>
            <a @click="openModal('editLanguages', modal.editLanguages)"
              >Idiomas</a
            >
            <a @click="openModal('allFilials', modal.allFilials)">Lojas</a>
            <a @click="openModal('allUsers', modal.allUsers)">Usuários</a>
          </div>
        </div>

        <a href="#" class="menu-item" @click="logout"> Sair </a>
      </div>
    </nav>
    <!-- FIM HEADER -->

    <!-- ADD MODAL -->
    <add-game-modal v-model="modal.addGame"></add-game-modal>
    <add-filial-modal v-model="modal.addFilial"></add-filial-modal>
    <add-user-modal v-model="modal.addUser"></add-user-modal>

    <!-- EDIT MODAL -->
    <edit-profile-modal v-model="modal.editProfile"></edit-profile-modal>
    <edit-difficulties-modal
      v-model="modal.editDifficulties"
    ></edit-difficulties-modal>
    <edit-genres-modal v-model="modal.editGenres"></edit-genres-modal>
    <edit-languages-modal v-model="modal.editLanguages"></edit-languages-modal>
    <all-filials-modal
      v-model="modal.allFilials"
      v-on:addFilial="openModal('addFilial', modal.addFilial)"
    ></all-filials-modal>
    <all-users-modal
      v-model="modal.allUsers"
      v-on:addUser="openModal('addUser', modal.addUser)"
    ></all-users-modal>
  </div>
</template>

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
      window: {
        width: 0,
        height: 0,
      },
      screen: {
        phone: 767.98,
        tablet: 991.98,
      },
    };
  },

  created() {
    window.addEventListener("resize", this.handleResize);
    this.handleResize();
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
      this.$router
        .replace({
          name: "games",
        })
        .then(() => {
          this.signOutAction();
        });
    },

    openModal(property, value) {
      this.modal[property] = !value;
    },

    handleResize() {
      this.window.width = window.innerWidth;
      this.window.height = window.innerHeight;
    },
  },
};
</script>
