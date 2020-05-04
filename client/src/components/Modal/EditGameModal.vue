<template>
  <div class="modal-background" v-show="value">
    <div class="modal horizontal-modal">
      <div class="modal-header">
        <div class="modal-title-container">
          <p class="title">Edição de Jogo</p>
        </div>
        <div class="btn-close-modal">
          <font-awesome-icon :icon="['fas', 'times']" @click="close" />
        </div>
        <div class="divider-modal"></div>
      </div>

      <div class="modal-body">
        <form class="horizontal-form form-grid">
          <div class="form-group" :class="{ 'flex-col-6': !phone }">
            <label for="title" class="title-label">Título</label>
            <input
              type="text"
              name="title"
              class="form-input"
              v-model="game.title"
              required
            />
          </div>

          <div class="form-group flex-col-3" v-if="!phone">
            <label class="title-label">Nº Jogadores</label>
            <div class="row">
              <div class="input">
                <input
                  type="text"
                  class="form-input"
                  name="minPlayers"
                  v-model="game.minPlayers"
                  required
                />
              </div>
              <div class="letter">
                a
              </div>
              <div class="input">
                <input
                  type="text"
                  class="form-input"
                  name="maxPlayers"
                  v-model="game.maxPlayers"
                  required
                />
              </div>
            </div>
          </div>

          <div class="form-group flex-col-6" v-if="!phone">
            <label class="title-label">É Expansão?</label>
            <div class="row radio-input">
              <div>
                <input
                  type="radio"
                  name="exp_n"
                  value="0"
                  v-model="game.isExpansion"
                />
                <label for="exp_n">Não</label>
              </div>
              <div>
                <input
                  type="radio"
                  name="exp_s"
                  value="1"
                  v-model="game.isExpansion"
                />
                <label for="exp_s">Sim</label>
              </div>
            </div>
          </div>

          <div class="form-group-row" v-if="phone">
            <div class="form-group">
              <label class="title-label">Nº Jogadores</label>
              <div class="row">
                <div class="input">
                  <input
                    type="text"
                    class="form-input"
                    name="minPlayers"
                    v-model="game.minPlayers"
                    required
                  />
                </div>
                <div class="letter">
                  a
                </div>
                <div class="input">
                  <input
                    type="text"
                    class="form-input"
                    name="maxPlayers"
                    v-model="game.maxPlayers"
                    required
                  />
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="title-label">É Expansão?</label>
              <div class="row radio-input">
                <div>
                  <input
                    type="radio"
                    name="exp"
                    value="0"
                    v-model="game.isExpansion"
                    checked
                  />
                  <label for="exp_n">Não</label>
                </div>
                <div>
                  <input
                    type="radio"
                    name="exp"
                    value="1"
                    v-model="game.isExpansion"
                  />
                  <label for="exp_s">Sim</label>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group flex-col-3" v-if="!phone">
            <label class="title-label">Dificuldade</label>
            <select class="form-input" v-model="game.difficulties_id" required>
              <option
                v-for="difficulty in difficulties"
                v-bind:key="difficulty.id"
                v-bind:value="difficulty.id"
                >{{ difficulty.title }}</option
              >
            </select>
          </div>

          <div class="form-group flex-col-3" v-if="!phone">
            <label class="title-label">Gênero</label>
            <select class="form-input" v-model="game.genres_id" required>
              <option
                v-for="genre in genres"
                v-bind:key="genre.id"
                v-bind:value="genre.id"
                >{{ genre.title }}</option
              >
            </select>
          </div>

          <div class="form-group-row" v-if="phone">
            <div class="form-group">
              <label class="title-label">Dificuldade</label>
              <select
                class="form-input"
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

            <div class="form-group">
              <label class="title-label">Gênero</label>
              <select class="form-input" v-model="game.genres_id" required>
                <option
                  v-for="genre in genres"
                  v-bind:key="genre.id"
                  v-bind:value="genre.id"
                  >{{ genre.title }}</option
                >
              </select>
            </div>
          </div>

          <div class="form-group flex-col-3" v-if="!phone">
            <label class="title-label">Idioma</label>
            <select class="form-input" v-model="game.languages_id" required>
              <option
                v-for="language in languages"
                v-bind:key="language.id"
                v-bind:value="language.id"
                >{{ language.title }}</option
              >
            </select>
          </div>

          <div class="form-group flex-col-3" v-if="!phone">
            <label class="title-label">Loja</label>
            <select class="form-input" v-model="game.filial_id" required>
              <option
                v-for="filial in filials"
                v-bind:key="filial.id"
                v-bind:value="filial.id"
                >{{ filial.title }}</option
              >
            </select>
          </div>

          <div class="form-group-row" v-if="phone">
            <div class="form-group">
              <label class="title-label">Idioma</label>
              <select class="form-input" v-model="game.languages_id" required>
                <option
                  v-for="language in languages"
                  v-bind:key="language.id"
                  v-bind:value="language.id"
                  >{{ language.title }}</option
                >
              </select>
            </div>

            <div class="form-group">
              <label class="title-label">Loja</label>
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
          </div>

          <div class="form-group flex-col-3" v-if="!phone">
            <label class="title-label">Tempo de Jogo (min.)</label>
            <div class="row">
              <div class="input">
                <input
                  type="text"
                  class="form-input"
                  name="minTime"
                  v-model="game.minTime"
                  required
                />
              </div>
              <div class="letter">
                a
              </div>
              <div class="input">
                <input
                  type="text"
                  class="form-input"
                  name="maxTime"
                  v-model="game.maxTime"
                  required
                />
              </div>
            </div>
          </div>

          <div class="form-group flex-col-1" v-if="!phone">
            <label for="price" class="title-label">Preço</label>
            <input
              type="text"
              name="price"
              class="form-input"
              v-model="game.price"
              required
            />
          </div>

          <div class="form-group-row" v-if="phone">
            <div class="form-group ">
              <label class="title-label">Tempo de Jogo</label>
              <div class="row">
                <div class="input">
                  <input
                    type="text"
                    class="form-input"
                    name="minTime"
                    v-model="game.minTime"
                    required
                  />
                </div>
                <div class="letter">
                  a
                </div>
                <div class="input">
                  <input
                    type="text"
                    class="form-input"
                    name="maxTime"
                    v-model="game.maxTime"
                    required
                  />
                </div>
              </div>
            </div>

            <div class="form-group ">
              <label for="price" class="title-label">Preço</label>
              <input
                type="text"
                name="price"
                class="form-input"
                v-model="game.price"
                required
              />
            </div>
          </div>

          <div class="form-group" :class="{ 'flex-col-3': !phone }">
            <label for="obslang" class="title-label">Obs. Idioma</label>
            <input
              type="text"
              name="obslang"
              class="form-input"
              v-model="game.languageObs"
            />
          </div>

          <div class="form-group" :class="{ 'flex-col-5': !phone }">
            <label for="image" class="title-label">Imagem (URL)</label>
            <input
              type="text"
              name="image"
              class="form-input"
              v-model="game.imageThumb"
            />
          </div>

          <div class="form-group" :class="{ 'flex-col-12': !phone }">
            <label for="description" class="title-label">Descrição</label>
            <textarea class="form-input" v-model="game.description"></textarea>
          </div>

          <div class="form-group" :class="{ 'flex-col-3': !phone }">
            <label class="title-label">Disponível</label>
            <div class="row radio-input h-fix">
              <div>
                <input
                  type="radio"
                  name="available"
                  value="1"
                  v-model="game.isAvailable"
                />
                <label for="exp_s">Sim</label>
              </div>
              <div>
                <input
                  type="radio"
                  name="available"
                  value="0"
                  v-model="game.isAvailable"
                />
                <label for="exp_n">Não</label>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-blue form-btn" @click="edit">
          Salvar
        </button>
        <button
          type="submit"
          class="btn btn-red form-btn ml-10"
          @click="remove"
        >
          Excluir
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import EventBus from "@/main.js";
import Axios from "axios";
import { responsive } from "@/mixins/responsive";

export default {
  name: "EditGameModal",
  mixins: [responsive],

  data() {
    return {
      game: {
        id: "",
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

      let difficulties = "difficulties/all";
      let genres = "genres/all";
      let languages = "languages/all";
      let filials = "filials/all";
      let game = "games/game=" + id;

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
        request_game,
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

    edit() {
      Axios.put("games/edit", this.game)
        .then((res) => {
          alert("Jogo " + res.data.data.title + " modificado com sucesso!");
        })
        .catch((err) => console.log(err));
      EventBus.$emit("fetch", "");
      this.close();
    },

    remove() {
      Axios.delete(`games/destroy/${this.game.id}`)
        .then(() => {
          alert("Jogo removido com sucesso!");
        })
        .catch((err) => console.log(err));
      EventBus.$emit("fetch", "");
      this.close();
    },
  },
};
</script>
