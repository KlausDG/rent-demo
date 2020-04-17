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
        <form @submit.prevent="add" class="form-horizontal" >
          <div class="row justify-content-md-center">
            <div class="form-group">
              <label for="title" class="title-label control-label">Título</label>
              <input type="text" name="title" class="form-control form-input" v-model="form.title" required/>
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
// import EventBus from "../../main.js";
import Axios from "axios";

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

    add() {
      Axios.post("http://127.0.0.1:8000/api/genre", this.form)
        .catch((err) => console.log(err));

      this.close();
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
