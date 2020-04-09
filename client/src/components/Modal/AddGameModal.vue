<template>
  <div class="modal-backdrop" v-show="value">
    <div class="add-game-modal">
      <div class="modal-container">
        <div class="modal-title">
          <p class="title">Cadastro de Jogo</p>
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
        <form @submit.prevent="submit">
          <div class="row">
            <div class="form-group col-md-5">
              <label for="title" class="title-label">Título</label>
              <input type="text" name="title" class="form-control form-input" />
            </div>

            <div class="form-group col-md-2">
              <label class="title-label">Nº Jogadores</label>
              <div class="row">
                <div class="col-md">
                  <input
                    type="text"
                    class="form-control form-input"
                    name="minPlayers"
                  />
                </div>
                <div class="letter">
                  a
                </div>
                <div class="col-md">
                  <input
                    type="text"
                    class="form-control form-input"
                    name="maxPlayers"
                  />
                </div>
              </div>
            </div>

            <div class="form-group col-md-2">
              <label class="title-label">Expansão</label>
              <div class="row radio-input form-control">
                <div>
                  <input type="radio" class="form-control" name="exp" />
                  <label for="exp_n">Não</label>
                </div>
                <div>
                  <input type="radio" class="form-control" name="exp" />
                  <label for="exp_s">Sim</label>
                </div>
              </div>
            </div>

            <div class="form-group col-md-3">
              <label class="title-label">Tempo de Jogo (min.)</label>
              <div class="row">
                <div class="col-md">
                  <input
                    type="text"
                    class="form-control form-input"
                    name="minTime"
                  />
                </div>
                <div class="letter">
                  a
                </div>
                <div class="col-md">
                  <input
                    type="text"
                    class="form-control form-input"
                    name="maxTime"
                  />
                </div>
              </div>
            </div>

            <div class="form-group col-md-1">
              <label for="price" class="title-label">Preço</label>
              <input type="text" name="price" class="form-control form-input" />
            </div>

            <div class="form-group col-md-2">
              <label class="title-label">Dificuldade</label>
              <select
                class="form-control form-input"
              >
                <option>1</option>
              </select>
            </div>

            <div class="form-group col-md-2">
              <label class="title-label">Gênero</label>
              <select
                class="form-control form-input"
              >
                <option>1</option>
              </select>
            </div>

            <div class="form-group col-md-2">
              <label class="title-label">Idioma</label>
              <select
                class="form-control form-input"
              >
                <option>1</option>
              </select>
            </div>
            
            <div class="form-group col-md-5">
              <label for="image" class="title-label">Imagem (URL)</label>
              <input type="text" name="image" class="form-control form-input"/>
            </div>

            <div class="form-group col-md-4">
              <label for="obslang" class="title-label">Obs. Idioma</label>
              <input
                type="text"
                name="obslang"
                class="form-control form-input"
              />
            </div>

            <div class="form-group col-md-8">
              <label for="description" class="title-label">Descrição</label>
              <textarea
                class="form-control form-input"
                id="description"
              ></textarea>
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
        minPlayers: "",
        maxPlayers: "",
        minTime: "",
        maxTime: "",
        isExpansion: "",
        isAvailable: true,
        price: "",
        description: "",
        image: "",
        imageThumb: "",
        difficulty: "",
        genreId: "",
        languageId: "",
        languageObs: "",
        fililal_id: "",
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
</style>
