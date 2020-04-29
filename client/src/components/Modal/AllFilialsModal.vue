<template>
  <div class="modal-background" v-show="value">
    <div class="modal vertical-modal">
      <div class="modal-header">
        <div class="modal-title-container">
          <p class="title">Lojas</p>
        </div>
        <div class="btn-close-modal">
          <font-awesome-icon :icon="['fas', 'times']" @click="close" />
        </div>
        <div class="divider-modal"></div>
      </div>

      <div class="modal-body">
        <form class="list-form mb-10">
          <div
            class="form-group"
            v-for="(filial, index) in filials"
            v-bind:key="index"
          >
            <div class="index-label">{{ index + 1 }} -</div>
            <input
              type="text"
              name="title"
              class="form-input"
              v-model="filials[index].title"
              disabled
            />
            <div class="item-submit">
              <button
                type="submit"
                class="btn btn-green ml-10"
                @click.prevent="editFilial(filials[index])"
              >
                Editar
              </button>
              <button
                type="submit"
                class="btn btn-red ml-10"
                @click.prevent="remove(filial.id)"
              >
                Deletar
              </button>
            </div>
          </div>

          <div class="result-message" v-bind:class="{ error: has_error }">
            <p>{{ resp }}</p>
          </div>

          <div class="divider-modal"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-blue form-btn" @click.prevent="newFilial">
          Nova Loja
        </button>
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

  watch: {
    value: function() {
      this.fetch();
    } 
  },

  props: {
    value: {
      required: true,
    },
  },

  created() {
    this.resp = "";
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
