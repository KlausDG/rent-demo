<template>
  <div>
    <Navbar />
    <div id="cabecalho" style="padding: 1rem 0 1rem 2rem;">
      <div class="filial-container">
        <h4 id="cabecalho-text">
          {{ current_filial.title }} ( {{ total_games }} )
        </h4>
      </div>
      <div class="search-item">
        <input
          class="form-control"
          id="search-input"
          type="text"
          placeholder="Procure por um jogo aqui"
          aria-label="Search"
          v-model="search_query"
        />
        <button class="search-btn" @click="search()">Procurar</button>
      </div>
    </div>

    <!-- Advanced Search -->
    <div class="adv-search" v-show="adv_search">
      <form v-on:submit.prevent>
        <div class="close-btn">
          <font-awesome-icon
            class="icon"
            :icon="['fas', 'times']"
            @click="adv_search = !adv_search"
          />
        </div>
        <div class="form-input">
          <div class="select-container">
            <div class="form-group">
              <div class="label">
                <font-awesome-icon
                  class="icon"
                  :icon="['fab', 'creative-commons-by']"
                />
                <div class="divider"></div>
                <label for="player-qtd"> Nº de Jogadores</label>
              </div>
              <select
                id="player-qtd"
                class="custom-form custom-select custom-select dropdown"
                v-model="filter_player_qtd"
              >
                <option value="0">Todos</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6+">6+</option>
              </select>
            </div>
            <div class="form-group">
              <div class="label">
                <font-awesome-icon
                  class="icon"
                  :icon="['fab', 'acquisitions-incorporated']"
                />
                <!-- <i class="fab fa-acquisitions-incorporated"></i> -->
                <div class="divider"></div>
                <label for="language">Idioma</label>
              </div>
              <select
                id="language"
                class="custom-form custom-select custom-select dropdown"
                v-model="filter_language"
              >
                <option value="0">Todos</option>
                <option value="1">Português</option>
                <option value="2">Inglês</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="label">
              <font-awesome-icon class="icon" :icon="['fas', 'book-reader']" />
              <!-- <i class="fas fa-book-reader"></i> -->
              <div class="divider"></div>
              <label>Dificuldade</label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="checkbox"
                value="1"
                v-model="filter_difficulty"
              />
              <label class="form-check-label" for="facil">
                Fácil
              </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="checkbox"
                value="2"
                v-model="filter_difficulty"
              />
              <label class="form-check-label" for="normal">
                Normal
              </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="checkbox"
                value="3"
                v-model="filter_difficulty"
              />
              <label class="form-check-label" for="intermediario">
                Intermediário
              </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="checkbox"
                value="4"
                v-model="filter_difficulty"
              />
              <label class="form-check-label" for="dificil">
                Difícil
              </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="checkbox"
                value="5"
                v-model="filter_difficulty"
              />
              <label class="form-check-label" for="muito-dificil">
                Muito Difícil
              </label>
            </div>
          </div>
          <div class="form-group">
            <div class="label">
              <font-awesome-icon class="icon" :icon="['fas', 'cog']" />
              <!-- <i class="fas fa-cog"></i> -->
              <div class="divider"></div>
              <label for="genero">Gênero</label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="checkbox"
                value="1"
                v-model="filter_genre"
              />
              <label class="form-check-label" for="festivo">
                Festivo
              </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="checkbox"
                value="2"
                v-model="filter_genre"
              />
              <label class="form-check-label" for="infantil">
                Infantil
              </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="checkbox"
                value="3"
                v-model="filter_genre"
              />
              <label class="form-check-label" for="familia">
                Família
              </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="checkbox"
                value="4"
                v-model="filter_genre"
              />
              <label class="form-check-label" for="estrategico">
                Estratégico
              </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="checkbox"
                value="5"
                v-model="filter_genre"
              />
              <label class="form-check-label" for="tematico">
                Temático
              </label>
            </div>
          </div>
        </div>
        <div class="btn-container">
          <button class="search-btn" @click="closeFilterPanel">
            Aplicar
          </button>
        </div>
      </form>
    </div>

    <div class="main-container">
      <div class="nav-and-filters-container">
        <!-- Navigation -->
        <nav aria-label="navigation">
          <ul class="pagination">
            <li
              v-bind:class="[{ disabled: !pagination.prev_page_url }]"
              class="page-item"
            >
              <a
                class="page-link"
                href="#"
                @click="fetchGames(pagination.prev_page_url)"
                >Anterior</a
              >
            </li>
            <li class="page-item disabled">
              <a class="page-link">
                {{
                  pagination.last_page > 1
                    ? pagination.current_page + " de " + pagination.last_page
                    : "1 de 1"
                }}</a
              >
            </li>
            <li
              v-bind:class="[{ disabled: !pagination.next_page_url }]"
              class="page-item"
            >
              <a
                class="page-link"
                href="#"
                @click="fetchGames(pagination.next_page_url)"
                >Próximo</a
              >
            </li>
          </ul>
        </nav>
        <!-- End of Navigation -->

        <div class="dropdown-container">
          <div class="exibit-dropdown">
            <p style="margin: 0;">
              Exibir:
            </p>
            <select
              class="custom-form custom-select custom-select dropdown"
              id="sort-options"
              name="sort-options"
              v-model="display_qtd"
              v-on:change="fetchGames()"
            >
              <option value="15">15 jogos por página</option>
              <option value="30">30 jogos por página</option>
              <option value="60">60 jogos por página</option>
              <option value="120">120 jogos por página</option>
              <option value="120">240 jogos por página</option>
              <option value="todos">Todos os jogos</option>
            </select>
          </div>
          <div class="exibit-dropdown">
            <p style="margin: 0;">
              Odernar:
            </p>
            <select
              class="custom-form custom-select custom-select dropdown"
              id="sort-options"
              name="sort-options"
              v-model="sort_params"
              v-on:change="fetchGames()"
            >
              <option value="title asc">A-Z</option>
              <option value="title desc">Z-A</option>
              <option value="price asc">Menor Preço</option>
              <option value="price desc">Maior Preço</option>
            </select>
          </div>
          <div class="adv-filter-btn-container">
            <button
              class="search-btn btn btn-light btn-lg"
              @click="adv_search = !adv_search"
            >
              Mais Filtros
            </button>
            <button
              class="search-btn btn btn-light btn-lg"
              @click="clearFilter"
            >
              Limpar Filtros
            </button>
          </div>
        </div>
      </div>

      <div class="flex-container" v-if="total_games != 0">
        <div class="game-thumb" v-for="game in games" v-bind:key="game.id">
          <div
            class="not-available-overlay"
            v-bind:class="{ not_available: !game.isAvailable }"
          >
            <p>INDISPONÍVEL</p>
          </div>

          <div class="game-container">
            <div class="left-container">
              <!-- Image -->
              <div class="game-image-container">
                <div class="game-hexagon">
                  <div class="game-image-limiter">
                    <div
                      class="game-image"
                      :style="{
                        backgroundImage: 'url(' + game.imageThumb + ')',
                      }"
                    ></div>
                  </div>
                </div>
              </div>
              <div class="button-container">
                <button
                  @click="sendMessage(game.title)"
                  :disabled="!game.isAvailable"
                >
                  {{ game.isAvailable ? "Alugar" : "Indisponível" }}
                </button>
              </div>
            </div>
            <!-- Info -->
            <div class="game-info-container">
              <!-- Title -->
              <div class="game-title">
                <h3>{{ game.title }}</h3>
              </div>
              <!-- Items -->
              <div class="game-info">
                <div class="info-row">
                  <div class="info-item">
                    <font-awesome-icon
                      class="icon"
                      :icon="['fab', 'creative-commons-by']"
                    />
                    <div class="divider"></div>
                    <div class="center-align">
                      <p>
                        {{
                          game.minPlayers === game.maxPlayers
                            ? game.minPlayers
                            : game.minPlayers + " a " + game.maxPlayers
                        }}
                      </p>
                    </div>
                  </div>
                  <div class="info-item">
                    <font-awesome-icon
                      class="icon"
                      :icon="['fas', 'book-reader']"
                    />
                    <div class="divider"></div>
                    <p>{{ game.difficulty.title }}</p>
                  </div>
                </div>
                <div class="info-row">
                  <div class="info-item">
                    <font-awesome-icon class="icon" :icon="['far', 'clock']" />
                    <div class="divider"></div>
                    <p>
                      {{
                        game.minTime === game.maxTime
                          ? game.minTime
                          : game.minTime + "-" + game.maxTime
                      }}
                      min
                    </p>
                  </div>
                  <div class="info-item">
                    <font-awesome-icon class="icon" :icon="['fas', 'cog']" />
                    <div class="divider"></div>
                    <p>{{ game.genre.title }}</p>
                  </div>
                </div>
                <div class="info-row">
                  <div class="info-item">
                    <font-awesome-icon
                      class="icon"
                      :icon="['fab', 'acquisitions-incorporated']"
                    />
                    <div class="divider"></div>
                    <p>{{ game.language.title }}</p>
                  </div>
                  <div class="info-item">
                    <font-awesome-icon
                      class="icon"
                      :icon="['far', 'money-bill-alt']"
                    />
                    <div class="divider"></div>
                    <p>
                      <span>R$ {{ game.price }}</span>
                    </p>
                  </div>
                </div>
              </div>
              <div class="game-rent-container"></div>
            </div>
          </div>
        </div>
      </div>
      <div v-else class="no-items-found">
        <p>Nenhum jogo encontrado.</p>
      </div>

      <!-- Navigation -->
      <nav aria-label="navigation">
        <ul class="pagination">
          <li
            v-bind:class="[{ disabled: !pagination.prev_page_url }]"
            class="page-item"
          >
            <a
              class="page-link"
              href="#"
              @click="fetchGames(pagination.prev_page_url)"
              >Anterior</a
            >
          </li>
          <li class="page-item disabled">
            <a class="page-link">{{
              pagination.last_page > 1
                ? pagination.current_page + " de " + pagination.last_page
                : "1 de 1"
            }}</a>
          </li>
          <li
            v-bind:class="[{ disabled: !pagination.next_page_url }]"
            class="page-item"
          >
            <a
              class="page-link"
              href="#"
              @click="fetchGames(pagination.next_page_url)"
              >Próximo</a
            >
          </li>
        </ul>
      </nav>
      <!-- End of Navigation -->
    </div>
    <Footer />
  </div>
</template>

<script>
import Navbar from "@/components/Navbar";
import Footer from "@/components/Footer";
import EventBus from "../main.js";
import Axios from "axios";

export default {
  components: {
    Navbar,
    Footer,
  },

  data() {
    return {
      //Filiais
      current_filial: {},
      //Jogos
      games: [],
      game: {
        id: "",
        title: "",
        minPlayers: "",
        maxPlayers: "",
        minTime: "",
        maxTime: "",
        isExpansion: "",
        isAvailable: "",
        dtaIniRent: "",
        dtaEndRent: "",
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
      game_id: "",
      pagination: {},
      total_games: "",
      display_qtd: 15,
      //Searching
      search_query: "",
      //Sorting
      sort_params: "title asc",
      sort_target: "",
      sort_value: "",
      //Filtering
      filter_player_qtd: 0,
      filter_language: 0,
      filter_difficulty: [],
      filter_genre: [],
      adv_search: false,
      contact: "981432111",
    };
  },

  created() {
    let vm = this;
    EventBus.$on("home", function() {
      vm.clearFilter();
    });
    EventBus.$on("changeFilial", function(payload) {
      vm.current_filial = payload;
      vm.clearFilter();
    });
  },

  methods: {
    fetchGames(page_url) {
      let vm = this;
      let string_difficulty = 0;
      let string_genre = 0;

      this.sort_target = this.sort_params.split(" ")[0];
      this.sort_value = this.sort_params.split(" ")[1];

      this.filter_difficulty.length > 0
        ? (string_difficulty = this.filter_difficulty
            .toString()
            .split(",")
            .join(":"))
        : (string_difficulty = 0);

      this.filter_genre.length > 0
        ? (string_genre = this.filter_genre
            .toString()
            .split(",")
            .join(":"))
        : (string_genre = 0);

      page_url =
        page_url ||
        "games/filial/" +
          this.current_filial.id +
          "/sort/" +
          this.display_qtd +
          "&" +
          this.sort_target +
          "&" +
          this.sort_value +
          "/filter/" +
          this.filter_player_qtd +
          "&" +
          this.filter_language +
          "&" +
          string_difficulty +
          "&" +
          string_genre;

      Axios.get(page_url)
        .then((res) => {
          vm.games = res.data.data;
          vm.total_games = res.data.meta.total;
          vm.makePagination(res.data.meta, res.data.links);
        })
        .catch((err) => console.log(err));
    },

    makePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev,
      };

      this.pagination = pagination;
    },
    deleteGame(id) {
      if (confirm("Are you sure?")) {
        Axios.post(`http://127.0.0.1:8000/api/game/${id}`, {
          method: "delete",
        })
          .then(() => {
            alert("Game removed");
            this.fetchGames();
          })
          .catch((err) => console.log(err));
        // fetch(`http://127.0.0.1:8000/api/game/${id}`, {
        // 	method: "delete",
        // })
        // 	.then((res) => res.json())
        // 	.then(() => {
        // 		alert("Game removed");
        // 		this.fetchGames();
        // 	})
        // 	.catch((err) => console.log(err));
      }
    },

    editGame(game) {
      this.edit = true;
      this.game.id = game.id;
      this.game.game_id = game.id;
      this.title = game.title;
      this.price = game.price;
    },

    search(page_url) {
      let vm = this;
      let regex = /^[a-zA-Z0-9\s]*$/;
      let query = "";

      if (regex.test(this.search_query)) {
        query = this.search_query.split(" ").join("%20");
      } else {
        query = "!err";
      }

      this.search_query = "";

      page_url =
        page_url ||
        "http://127.0.0.1:8000/api/games/filial/" +
          this.current_filial.id +
          "/sort/" +
          this.display_qtd +
          "&" +
          this.sort_target +
          "&" +
          this.sort_value +
          "/search/" +
          query;

      Axios.get(page_url)
        .then((res) => {
          vm.games = res.data.data;
          vm.total_games = res.data.meta.total;
          vm.makePagination(res.data.meta, res.data.links);
        })
        .catch((err) => console.log(err));

      // fetch(page_url)
      //   .then((res) => res.json())
      //   .then((res) => {
      //     vm.games = res.data;
      //     vm.total_games = res.meta.total;
      //     vm.makePagination(res.meta, res.links);
      //   })
      //   .catch((err) => console.log(err));
    },

    sendMessage(title) {
      let message = "Olá! Gostaria de alugar o jogo " + title;
      let formatedMessage = message.split(" ").join("%20");
      let url =
        "https://wa.me/5555" + this.contact + "?text=" + formatedMessage;
      window.open(url, "_blank");
    },

    selectFilial(e) {
      this.current_filial = e.currentTarget.id.split("_")[1];
    },

    closeFilterPanel() {
      this.fetchGames();
      this.adv_search = !this.adv_search;
    },

    clearFilter() {
      this.filter_player_qtd = 0;
      this.filter_language = 0;
      this.filter_difficulty = [];
      this.filter_genre = [];
      this.search_query = "";
      this.fetchGames();
    },
  },
};
</script>

<style lang="scss">
@import "../sass/Games.scss";
</style>
