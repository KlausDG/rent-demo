<template>
  <div class="modal-background" v-show="value">
    <div class="modal vertical-modal">
      <div class="modal-header">
        <div class="modal-title-container">
          <p class="title">Idiomas</p>
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
            v-for="(language, index) in languages"
            v-bind:key="index"
          >
            <div class="index-label" v-if="!phone">{{ index + 1 }} -</div>
            <input
              type="text"
              name="title"
              class="form-input"
              v-model="languages[index].title"
              required
            />
            <div class="item-submit">
              <button
                type="submit"
                class="btn btn-green"
                :class="{ 'btn-sm': phone, 'ml-10': !phone }"
                @click.prevent="edit(languages[index])"
              >
                Salvar
              </button>
              <button
                type="submit"
                class="btn btn-red"
                :class="{ 'btn-sm': phone, 'ml-10': !phone }"
                @click.prevent="remove(language.id)"
              >
                Deletar
              </button>
            </div>
          </div>

          <div class="divider-modal"></div>

          <div class="form-group">
            <div class="index-label" v-if="!phone">
              {{ languages.length + 1 }} -
            </div>
            <input
              type="text"
              name="title"
              class="form-control form-input"
              v-model="newLanguage.title"
              placeholder="Adicionar novo idioma"
              required
            />
            <div class="item-submit-single">
              <button
                type="submit"
                class="btn btn-green ml-10"
                @click.prevent="add"
              >
                Salvar
              </button>
              <div class="spacer ml-10"></div>
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
          @click.prevent="editAll"
        >
          Salvar Todos
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import Axios from "axios";
import { responsive } from "@/mixins/responsive";

export default {
  name: "languagesModal",
  mixins: [responsive],

  data() {
    return {
      newLanguage: {
        title: "",
      },
      languages: [],
      resp: "",
      has_error: false,
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

      Axios.get("languages/all")
        .then((res) => {
          console.log("Fetch -> All Languages");
          vm.languages = res.data;
        })
        .catch((err) => console.log(err));
    },

    add() {
      this.has_error = false;
      let vm = this;
      Axios.post("languages/add", this.newLanguage)
        .then((res) => {
          vm.resp = "Idioma " + res.data.title + " adicionado com sucesso!";
          vm.newLanguage.title = "";
          vm.fetch();
        })
        .catch((err) => console.log(err));
    },

    async edit(dif) {
      this.has_error = false;
      let vm = this;
      await Axios.put("languages/edit", dif)
        .then((res) => {
          vm.resp =
            "Idioma " +
            res.data.id +
            " foi alterado com sucesso para " +
            res.data.title;
          vm.fetch();
        })
        .catch((err) => console.log(err));
    },

    async editAll() {
      let vm = this;
      this.has_error = false;
      this.languages.forEach(async (element) => {
        await Axios.put("languages/edit", element).catch((err) => {
          vm.has_error = true;
          console.log(err);
        });
      });

      if (!this.has_error) {
        alert("Alterações concluidas com sucesso!");
        this.close();
      } else {
        this.resp = "Algo ocorreu errado... Alterações não foram salvas";
      }
    },

    async remove(id) {
      this.has_error = false;
      let vm = this;
      await Axios.delete("languages/lang=" + id)
        .then((res) => {
          vm.resp = "Idioma " + res.data.title + " removido com sucesso!";
        })
        .catch((err) => console.log(err));

      this.fetch();
    },
  },
};
</script>
