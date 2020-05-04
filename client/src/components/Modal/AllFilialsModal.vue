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
            <div class="index-label" v-if="!phone">{{ index + 1 }} -</div>
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
                class="btn btn-green"
                :class="{ 'btn-sm': phone, 'ml-10': !phone }"
                @click.prevent="editFilial(filials[index])"
              >
                Editar
              </button>
              <button
                type="submit"
                class="btn btn-red"
                :class="{ 'btn-sm': phone, 'ml-10': !phone }"
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
        <button
          type="submit"
          class="btn btn-blue form-btn"
          @click.prevent="newFilial"
        >
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
import { responsive } from "@/mixins/responsive";

export default {
  name: "filialsModal",
  mixins: [responsive],

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
      if (this.value != false) {
        this.fetch();
      }
    },
  },

  props: {
    value: {
      required: true,
    },
  },

  created() {
    this.resp = "";
  },

  methods: {
    close() {
      this.$emit("input", !this.value);
    },

    fetch() {
      let vm = this;

      Axios.get("filials/all")
        .then((res) => {
          console.log("Fetch -> All Filials");
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
