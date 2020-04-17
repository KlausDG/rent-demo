<template>
  <div class="modal-backdrop" v-show="value">
    <div class="modal-main">
      <div class="title-container">
        <div class="modal-title">
          <p class="title">Dificuldades</p>
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
              v-for="(difficulty, index) in difficulties"
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
                  v-model="difficulties[index].title"
                  required
                />
              </div>
              <div class="item-submit">
                <button
                  type="submit"
                  class="btn btn-success"
                  @click.prevent="edit(difficulties[index])"
                >
                  Salvar
                </button>
                <button
                  type="submit"
                  class="btn btn-danger"
                  @click.prevent="remove(difficulty.id)"
                >
                  Deletar
                </button>
              </div>
            </div>

            <div class="form-group">
              <div class="title-label">
                <p>12 -</p>
              </div>
              <div class="input-container">
                <input
                  type="text"
                  name="title"
                  class="form-control form-input"
                  v-model="newDifficulty.title"
                  placeholder="Adicionar nova dificuldade aqui"
                  required
                />
              </div>
              <div class="item-submit">
                <button
                  type="submit"
                  class="btn btn-success"
                  @click.prevent="add"
                >
                  Salvar
                </button>
                <div class="spacer"></div>
              </div>
            </div>
          </div>
          <div class="result-message" v-bind:class="{error: has_error}">
            <p>{{ resp }}</p>

          </div>
          <div class="custom-btn d-flex justify-content-center pb-4">
            <button
              type="submit"
              class="btn btn-primary"
              @click.prevent="editAll"
            >
              Salvar Todos
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
// import EventBus from "@/main.js";
import Axios from "axios";

export default {
  name: "DifficultiesModal",

  data() {
    return {
      newDifficulty: {
        title: "",
      },
      difficulties: [],
      resp: "",
      has_error: false,
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

      Axios.get("difficulties")
        .then((res) => {
          vm.difficulties = res.data;
        })
        .catch((err) => console.log(err));
    },

    add() {
      this.has_error = false;
      let vm = this;
      Axios.post("difficulty", this.newDifficulty)
        .then((res) => {
          vm.resp =
            "Dificuldade " + res.data.title + " adicionada com sucesso!";
          vm.newDifficulty.title = "";
          vm.fetch();
        })
        .catch((err) => console.log(err));
    },

    async edit(dif) {
      this.has_error = false;
      let vm = this;
      await Axios.put("difficulty", dif)
        .then((res) => {
          vm.resp =
            "Dificuldade " +
            res.data.id +
            " foi alterada com sucesso para " +
            res.data.title;
          vm.fetch();
        })
        .catch((err) => console.log(err));
    },

    async editAll() {
      let vm = this;
      this.has_error = false;
      this.difficulties.forEach(async (element) => {
        await Axios.put("difficulty", element).catch((err) => {
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
      await Axios.delete("difficulty/" + id)
        .then((res) => {
          vm.resp = "Dificuldade " + res.data.title + " removida com sucesso!";
        })
        .catch((err) => console.log(err));

      this.fetch();
    },
  },
};
</script>

<style lang="scss" scoped>
@import "@/sass/ListModal.scss";
</style>
