<template>
  <div class="modal-backdrop" v-show="value">
    <div class="add-game-modal">
      <div class="modal-container">
        <div class="modal-title">
          <p class="title">Edição de Jogo</p>
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
        <form @submit.prevent="editGame">
          <div class="row">
            <div class="form-group col-md-5">
              <label for="title" class="title-label">Título</label>
              <input
                type="text"
                name="title"
                class="form-control form-input"
                v-model="game.title"
                required
              />
            </div>

            <div class="form-group col-md-2">
              <label class="title-label">Nº Jogadores</label>
              <div class="row">
                <div class="col-md">
                  <input
                    type="text"
                    class="form-control form-input"
                    name="minPlayers"
                    v-model="game.minPlayers"
                    required
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
                    v-model="game.maxPlayers"
                    required
                  />
                </div>
              </div>
            </div>

            <div class="form-group col-md-2">
              <label class="title-label">É Expansão?</label>
              <div class="row radio-input form-control">
                <div>
                  <input
                    type="radio"
                    class="form-control"
                    name="exp_n"
                    value="0"
                    v-model="game.isExpansion"
                  />
                  <label for="exp_n">Não</label>
                </div>
                <div>
                  <input
                    type="radio"
                    class="form-control"
                    name="exp_s"
                    value="1"
                    v-model="game.isExpansion"
                  />
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
                    v-model="game.minTime"
                    required
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
                    v-model="game.maxTime"
                    required
                  />
                </div>
              </div>
            </div>

            <div class="form-group col-md-1">
              <label for="price" class="title-label">Preço</label>
              <input
                type="text"
                name="price"
                class="form-control form-input"
                v-model="game.price"
                required
              />
            </div>

            <div class="form-group col-md-2">
              <label class="title-label">Dificuldade</label>
              <select
                class="form-control form-input"
                v-model="game.difficulties_id"
                required
              >
                <option
                  v-for="difficulty in difficulties"
                  v-bind:key="difficulty.id"
                  v-bind:value="difficulty.id"
                  >{{ difficulty.title }}</option
                >
              </select>
            </div>

            <div class="form-group col-md-2">
              <label class="title-label">Gênero</label>
              <select
                class="form-control form-input"
                v-model="game.genres_id"
                required
              >
                <option
                  v-for="genre in genres"
                  v-bind:key="genre.id"
                  v-bind:value="genre.id"
                  >{{ genre.title }}</option
                >
              </select>
            </div>

            <div class="form-group col-md-2">
              <label class="title-label">Idioma</label>
              <select
                class="form-control form-input"
                v-model="game.languages_id"
                required
              >
                <option
                  v-for="language in languages"
                  v-bind:key="language.id"
                  v-bind:value="language.id"
                  >{{ language.title }}</option
                >
              </select>
            </div>

            <div class="form-group col-md-2">
              <label class="title-label">Filial</label>
              <select
                class="form-control form-input"
                v-model="game.filial_id"
                required
              >
                <option
                  v-for="filial in filials"
                  v-bind:key="filial.id"
                  v-bind:value="filial.id"
                  >{{ filial.title }}</option
                >
              </select>
            </div>

            <div class="form-group col-md-3">
              <label for="obslang" class="title-label">Obs. Idioma</label>
              <input
                type="text"
                name="obslang"
                class="form-control form-input"
                v-model="game.languageObs"
              />
            </div>

            <div class="form-group col-md-5">
              <label for="image" class="title-label">Imagem (URL)</label>
              <input
                type="text"
                name="image"
                class="form-control form-input"
                v-model="game.imageThumb"
              />
            </div>

            <div class="form-group col-md-7">
              <label for="description" class="title-label">Descrição</label>
              <textarea
                class="form-control form-input"
                v-model="game.description"
              ></textarea>
            </div>

            <div class="form-group col-md-2">
              <label class="title-label">Disponível</label>
              <div class="row radio-input form-control">
                <div>
                  <input
                    type="radio"
                    class="form-control"
                    name="exp"
                    value="1"
                    v-model="game.isAvailable"
                  />
                  <label for="exp_s">Sim</label>
                </div>
                <div>
                  <input
                    type="radio"
                    class="form-control"
                    name="exp"
                    value="0"
                    v-model="game.isAvailable"
                  />
                  <label for="exp_n">Não</label>
                </div>
              </div>
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
import EventBus from "@/main.js";
import Axios from "axios";

export default {
  name: "EditGameModal",

  data() {
    return {
      game: {
        title: "",
        minPlayers: "",
        maxPlayers: "",
        minTime: "",
        maxTime: "",
        isExpansion: 0,
        isAvailable: "",
        price: "",
        description: "",
        imageThumb: "",
        difficulties_id: "",
        genres_id: "",
        languages_id: "",
        languageObs: "",
        filial_id: "",
      },
      difficulties: [],
      genres: [],
      languages: [],
      filials: [],
    };
  },

  props: {
    // game_id: [Number, String],
    value: {
      required: true,
    },
  },

  created() {
    let vm = this;
    EventBus.$on("search", function(payload) {
      vm.fetch(payload);
    });
  },

  methods: {
    close() {
      this.$emit("input", !this.value);
    },

    fetch(id) {
      let vm = this;

      let difficulties = "http://127.0.0.1:8000/api/difficulties";
      let genres = "http://127.0.0.1:8000/api/genres";
      let languages = "http://127.0.0.1:8000/api/languages";
      let filials = "http://127.0.0.1:8000/api/filials";
      let game = "http://127.0.0.1:8000/api/game/" + id;

      const request_difficulties = Axios.get(difficulties);
      const request_genres = Axios.get(genres);
      const request_languages = Axios.get(languages);
      const request_filial = Axios.get(filials);
      const request_game = Axios.get(game);

      Axios.all([
        request_difficulties,
        request_genres,
        request_languages,
        request_filial,
        request_game
      ])
        .then(
          Axios.spread((...responses) => {
            vm.difficulties = responses[0].data;
            vm.genres = responses[1].data;
            vm.languages = responses[2].data;
            vm.filials = responses[3].data;
            vm.game = responses[4].data.data;
          })
        )
        .catch((err) => console.log(err));
    },

    editGame() {
      Axios.put("game", this.game)
        .then((res) => {
          alert("Jogo modificado com sucesso!");
          console.log(res);
        })
        .catch((err) => console.log(err));
      EventBus.$emit('fetch', '');
      this.close();
    },
  },
};
</script>

<style lang="scss" scoped>
@import "@/sass/AddGameModal.scss";

.add-game-modal {
  height: 580px !important;
}
</style>
