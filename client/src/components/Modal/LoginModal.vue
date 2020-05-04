<template>
  <div class="modal-background" v-show="value">
    <div class="login-modal-container modal">
      <div class="modal-header">
        <div class="modal-title-container">
          <p class="title">Área Restrita</p>
          <p class="subtitle">
            Acesso somente para administradores.
          </p>
        </div>
        <div class="btn-close-modal">
          <font-awesome-icon :icon="['fas', 'times']" @click="close" />
        </div>
      </div>

      <div class="modal-body">
        <form class="vertical-form">
          <div class="form-group">
            <input
              type="text"
              class="form-input"
              name="username"
              placeholder="Usuário"
              v-model="form.username"
              required
            />
          </div>
          <div class="form-group">
            <input
              type="password"
              class="form-input"
              name="pwd"
              placeholder="Senha"
              v-model="form.password"
              required
            />
          </div>
          <div class="error-container">
            <div class="form-error-message" v-if="has_error">
              - Usuário ou senha inválidos.
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-blue form-btn" @click="login">
          Entrar
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
  name: "signin",

  data() {
    return {
      form: {
        username: "",
        password: "",
      },
      has_error: false,
    };
  },

  props: {
    value: {
      required: true,
    },
  },

  methods: {
    ...mapActions({
      signIn: "auth/signIn",
    }),

    close() {
      this.$emit("input", !this.value);
    },

    login() {
      this.signIn(this.form)
        .then(() => {
          this.has_error = false;
          this.$emit("input", !this.value);
          this.$router.replace({
            name: "admin",
          });
        })
        .catch(() => (this.has_error = true));
    },
  },
};
</script>
