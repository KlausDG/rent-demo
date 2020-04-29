<template>
  <div class="modal-background" v-show="value">
    <div class="modal vertical-modal">
      <div class="modal-header">
        <div class="modal-title-container">
          <p class="title">Edição de Sócios</p>
        </div>
        <div class="btn-close-modal">
          <font-awesome-icon :icon="['fas', 'times']" @click="close" />
        </div>
        <div class="divider-modal"></div>
      </div>

      <div class="modal-body">
        <form class="vertical-form mb-20">
          <div class="form-group">
            <label for="name" class="title-label">Nome</label>
            <input
              type="text"
              name="name"
              class="form-input"
              placeholder="Nome"
              v-model="user.name"
              required
            />
          </div>

          <div class="form-group">
            <label for="username" class="title-label">Usuário</label>
            <input
              type="text"
              class="form-input"
              name="username"
              placeholder="Usuário"
              v-model="user.username"
              required
            />
          </div>

          <div class="form-group">
            <label for="email" class="title-label">E-mail</label>
            <input
              type="text"
              class="form-input"
              name="email"
              placeholder="E-mail"
              v-model="user.email"
              required
            />
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-blue form-btn" @click="formatData">Salvar</button>
      </div>
    </div>
  </div>
</template>

<script>
import EventBus from "@/main.js";
import Axios from "axios";

export default {
  name: "EditUserModal",

  data() {
    return {
      user: {
        name: "",
        username: "",
        email: "",
      },
    };
  },

  props: {
    value: {
      required: true,
    },
  },

  created() {
    let vm = this;
    EventBus.$on("searchUser", function(payload) {
      vm.user = payload;
    });
  },

  methods: {
    close() {
      this.$emit("input", !this.value);
    },

    formatData() {

//To Lower
      this.user.email = this.user.email.toLowerCase();

      this.addUser();
    },

    addUser() {
      Axios.put("users/edit", this.user)
        .then((res) => {
          alert("Usuário " + res.data.id + " alterado com sucesso!");
        })
        .catch((err) => console.log(err));

      this.close();
    },
  },
};
</script>
