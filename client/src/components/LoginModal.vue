<template>
  <div class="modal-backdrop" v-show="value">
    <div class="login-modal">
      <div class="modal-container">
        <div class="modal-title">
          <p class="title">Área Restrita</p>
          <p class="modal-subtitle">
            Acesso somente para administradores.
          </p>
        </div>
        <div class="btn-close">
          <font-awesome-icon
            class="icon"
            :icon="['fas', 'times']"
            @click="close"
          />
        </div>
      </div>
      <form @submit.prevent="submit">
        <div class="form-group">
          <input
            type="text"
            name="username"
            placeholder="Usuário"
            v-model="form.username"
            required
          />
        </div>
        <div class="form-group">
          <input
            type="password"
            name="pwd"
            placeholder="Senha"
            v-model="form.password"
            required
          />
        </div>

        <button type="submit" class="btn btn-primary custom-btn">
          Entrar
        </button>
        <p v-if="has_error">Usuário ou senha inválidos.</p>
      </form>
    </div>
  </div>
</template>

<script>
import EventBus from "../main.js";
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

    submit() {
      this.signIn(this.form).then(() => {
		this.has_error = false
		EventBus.$emit("login", this.form.username);
		this.$emit("input", !this.value);
      }).catch(() => this.has_error = true);
    },
  },
};
</script>

<style lang="scss" scoped>
@import "../sass/Main.scss";

.modal-backdrop {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: rgba(0, 0, 0, 0);
  display: flex;
  justify-content: center;
  align-items: center;

  .login-modal {
    background-color: $color_white;
    width: 30rem;
    height: 350px;
    box-shadow: 2px 2px 5px 1px;
    // overflow-x: auto;
    display: flex;
    flex-direction: column;
    border-radius: 10px;

    .modal-container {
      display: inline-block;
      position: relative;
      .modal-title {
        margin-top: 15px;
        padding-top: 10px;
        width: 100%;
        color: $color_black;
        font-size: $font_size_subtitle;
        font-weight: bolder;
        text-align: center;

        .title {
          margin: 0;
          text-transform: uppercase;
          letter-spacing: 1px;
        }

        .modal-subtitle {
          color: darken($main_color_1, 10);
          font-size: 10px;
        }
      }
      .btn-close {
        padding: 0.4rem 0.6rem;
        display: block;
        position: absolute;
        right: 10px;
        top: 5px;
        cursor: pointer;
        font-size: 20px;
        font-weight: bold;
        color: darken($main_color_1, 10);
      }
    }

    form {
      display: flex;
      flex-direction: column;
      margin: 25px auto 0 auto;

      .form-group {
        display: flex;
        flex-direction: column;
        border-radius: 5px;
        background-color: darken($color_grey, 7);
        height: 50px;
        width: 20rem;
        padding: 10px 0 10px 10px;

        input {
          background-color: darken($color_grey, 7);
          border: 0;
        }
      }
      .custom-btn {
        margin-top: 25px;
        width: 20rem;
        border-radius: 3px;
      }
    }
  }
}
</style>
