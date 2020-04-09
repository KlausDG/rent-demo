<template>
  <div class="modal-backdrop" v-show="value">
    <div class="add-game-modal">
      <div class="modal-container">
        <div class="modal-title">
          <p class="title">Cadastro de Gênero</p>
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
        <form @submit.prevent="submit" class="form-horizontal" >
          <div class="row justify-content-md-center">
            <div class="form-group">
              <label for="title" class="title-label control-label">Título</label>
              <input type="text" name="title" class="form-control form-input" />
            </div>

          </div>

          <div class="custom-btn d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import EventBus from "../../main.js";

export default {
  name: "signin",

  data() {
    return {
      form: {
        title: "",
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

    close() {
      this.$emit("input", !this.value);
    },

    submit() {
      this.signIn(this.form)
        .then(() => {
          this.has_error = false;
          EventBus.$emit("login", this.form.username);
          this.$emit("input", !this.value);
        })
        .catch(() => (this.has_error = true));
    },
  },
};
</script>

<style lang="scss" scoped>
@import "@/sass/AddGameModal.scss";
.add-game-modal {
  width: 35rem !important;
  height: 20rem !important;
}
</style>
