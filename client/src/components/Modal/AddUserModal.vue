<template>
  <div class="modal-background" v-show="value">
    <div class="modal vertical-modal">
      <div class="modal-header">
        <div class="modal-title-container">
          <p class="title">Cadastro de Usuário</p>
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
              v-model="user.username"
              required
            />
          </div>

          <div class="form-group col-md-12">
            <label for="email" class="title-label">E-mail</label>
            <input
              type="text"
              class="form-input"
              name="email"
              v-model="user.email"
              required
            />
          </div>

          <div class="form-group">
            <label for="password" class="title-label">Senha</label>
            <input
              type="password"
              name="password"
              class="form-input"
              v-model="user.password"
              required
            />
          </div>

          <div class="form-group last-input">
            <label for="v_password" class="title-label"
              >Confirmação de Senha</label
            >
            <input
              type="password"
              name="v_password"
              class="form-input"
              v-model="user.v_password"
              required
            />
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-blue form-btn" @click="formatData">
          Salvar
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import Axios from "axios";

export default {
  name: "AdduserModal",

  data() {
    return {
      user: {
        name: "",
        username: "",
        email: "",
        password: "",
        v_password: "",
      },
    };
  },

  props: {
    value: {
      required: true,
    },
  },

  methods: {
    close() {
      this.$emit("input", !this.value);
    },

    formatData() {
      if (this.user.password !== this.user.v_password) {
        alert("As senhas inseridas não são iguais!");
        return;
      }

      //To Lower
      this.user.email = this.user.email.toLowerCase();

      this.addUser();
    },

    addUser() {
      Axios.post("users/add", this.user)
        .then((res) => {
          alert("Usuário " + res.data.name + " cadastrado com sucesso!");
        })
        .catch((err) => console.log(err));

      this.close();
    },
  },
};
</script>
