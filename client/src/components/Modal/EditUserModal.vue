<template>
  <div class="modal-backdrop" v-show="value">
    <div class="add-game-modal">
      <div class="modal-container">
        <div class="modal-title">
          <p class="title">Edição de Sócios</p>
        </div>
        <div class="btn-close">
          <font-awesome-icon
            class="icon"
            :icon="['fas', 'times']"
            @click="close"
          />
        </div>
      </div>
      <div class="divider"></div>
      <div class="container">
        <form
          @submit.prevent="formatData"
          class=" d-flex flex-column justify-content-center"
        >
          <div class="form-group">
            <input
              type="text"
              name="name"
              class="form-control form-input"
              placeholder="Nome"
              v-model="user.name"
              required
            />
          </div>

          <div class="form-group">
            <input
              type="text"
              class="form-control form-input"
              name="username"
              placeholder="Usuário"
              v-model="user.username"
              required
            />
          </div>

          <div class="form-group">
            <input
              type="text"
              class="form-control form-input"
              name="email"
              placeholder="E-mail"
              v-model="user.email"
              required
            />
          </div>

          <div class="form-group">
            <input
              type="password"
              name="password"
              class="form-control form-input"
              placeholder="Senha antiga"
              v-model="user.old_password"
              required
            />
          </div>

          <div class="form-group">
            <input
              type="password"
              name="password"
              class="form-control form-input"
              placeholder="Senha"
              v-model="user.password"
              required
            />
          </div>

          <div class="form-group">
            <input
              type="password"
              name="v_password"
              class="form-control form-input"
              placeholder="Confirmação de senha"
              v-model="user.v_password"
              required
            />
          </div>
          <div class="custom-btn d-flex justify-content-center pb-4">
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </form>
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
        old_password: "",
        password: "",
        v_password: "",
      },
      confirm_old_password: "",
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
      vm.user.old_password = vm.user.password;
    });
  },

  methods: {
    close() {
      this.$emit("input", !this.value);
    },

    formatData() {
      if (this.user.old_password !== this.confirm_old_password) {
        alert("A senha antiga está errada!");
        return;
      }

      if (this.user.password !== this.user.v_password) {
        alert("As senhas inseridas não são iguais!");
        return;
      }

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

<style lang="scss" scoped>
@import "@/sass/AddGameModal.scss";

.container {
  margin-top: 15px;
  width: 500px;
}

.add-game-modal {
  width: 35rem !important;
  height: auto !important;
}

.form-input {
  border-color: #000000 !important;
  height: 2.5rem !important;
}
</style>
