<template>
  <div class="modal-backdrop" v-show="value">
    <div class="modal-main">
      <div class="title-container">
        <div class="modal-title">
          <p class="title">Filiais</p>
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
      <div class="modal-container">
        <form>
          <div class="flex-container">
            <div
              class="form-group"
              v-for="(filial, index) in filials"
              v-bind:key="index"
            >
              <div class="title-label">
                <p>{{ index + 1 }} -</p>
              </div>
              <div class="input-container">
                <input
                  type="text"
                  name="title"
                  class="form-control form-input"
                  v-model="filials[index].title"
                  disabled
                />
              </div>
              <div class="item-submit">
                <button
                  type="submit"
                  class="btn btn-success"
                  @click.prevent="editFilial(filials[index])"
                >
                  Editar
                </button>
                <button
                  type="submit"
                  class="btn btn-danger"
                  @click.prevent="remove(filial.id)"
                >
                  Deletar
                </button>
              </div>
            </div>

            <div class="divider"></div>
          </div>
          <div class="result-message" v-bind:class="{ error: has_error }">
            <p>{{ resp }}</p>
          </div>
          <div class="custom-btn d-flex justify-content-center pb-4">
            <button
              type="submit"
              class="btn btn-primary"
              @click.prevent="newFilial"
            >
              Cadastrar Nova Filial
            </button>
          </div>
        </form>
      </div>
    </div>
    <edit-filial-modal v-model="edit_filial_modal_open"></edit-filial-modal>
  </div>
</template>

<script>
import EventBus from "@/main.js";
import Axios from "axios";

export default {
  name: "filialsModal",

  data() {
    return {
      filials: [],
      resp: "",
      has_error: false,
      edit_filial_modal_open: false,
    };
  },

  props: {
    value: {
      required: true,
    },
  },

  created() {
    this.fetch();
  },

  methods: {
    close() {
      this.$emit("input", !this.value);
    },

    fetch() {
      let vm = this;

      Axios.get("filials/all")
        .then((res) => {
          vm.filials = res.data;
        })
        .catch((err) => console.log(err));
    },

    async editFilial(fil) {
      this.edit_filial_modal_open = !this.edit_filial_modal_open;
      EventBus.$emit("searchFilial", fil);

    },

    async remove(id) {
      this.has_error = false;
      let vm = this;
      await Axios.delete("filials/fil=" + id)
        .then((res) => {
          vm.resp = "filial " + res.data.title + " removida com sucesso!";
        })
        .catch((err) => console.log(err));

      this.fetch();
    },

    newFilial() {
      this.$emit("addFilial");
      this.close();
    },
  },
};
</script>

<style lang="scss" scoped>
@import "@/sass/ListModal.scss";
</style>
