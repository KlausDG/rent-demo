<template>
  <div class="all-container">
    <!-- <Sidebar class="sidebar"/> -->
    <div class="content-container">
      <NavbarAdmin class="nav-admin" />
      <div id="cabecalho" style="padding: 1rem 0 1rem 2rem;">
        <div class="filial-container">
          <h4 id="cabecalho-text">
            Todos os Jogos (12903)
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
            <div class="exibit-dropdown">
              <p style="margin: 0;">
                Jogos:
              </p>
              <select
                class="custom-form custom-select custom-select dropdown"
                id="sort-options"
                name="sort-options"
                v-model="display_filter"
                v-on:change="fetchGames()"
              >
                <option value="all">Todos os Jogos</option>
                <option value="false">Jogos Alugados</option>
                <option value="true">Jogos Disponíveis</option>
              </select>
            </div>
          </div>
        </div>

        <div class="flex-container" v-if="total_games != 0">
          <div class="game-thumb" v-for="game in games" v-bind:key="game.id">

            <div
              class="game-container"
              v-bind:class="{ not_available_admin: !game.isAvailable }"
            >
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
                  <button @click="openEditModal(game.id)">
                    Editar
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
                      <font-awesome-icon
                        class="icon"
                        :icon="['far', 'clock']"
                      />
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
    <edit-game-modal v-model="edit_game_modal_open"></edit-game-modal>
  </div>
</template>

<script>
import NavbarAdmin from "@/components/NavbarAdmin";
import Footer from "@/components/Footer";
import EventBus from "../main.js";
import Axios from "axios";
import { mapGetters } from "vuex";

export default {
  components: {
    NavbarAdmin,
    Footer,
  },

  data() {
    return {
      //Filial
      filial: {},
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
      edit: false,
      display_filter: "all",
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
      edit_game_modal_open: false,
      contact: "981432111",
    };
  },

  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user",
    }),
  },

  created() {
    let vm = this;
    EventBus.$on("home", function() {
      vm.clearFilter();
    });
    EventBus.$on("fetch", function() {
      vm.fetchGames();
    });
    this.fetchFilials();
  },

  methods: {
    fetchFilials(page_url) {
      let vm = this;

      page_url =
        page_url || "http://127.0.0.1:8000/api/filial/" + this.user.filial_id;

      Axios.get(page_url)
        .then((res) => {
          vm.filial = res.data;
          this.fetchGames();
        })
        .catch((err) => console.log(err));
    },

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
        "http://127.0.0.1:8000/api/games/filial/" +
          this.filial.id +
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

    openEditModal(game_id) {
      this.edit_game_modal_open = !this.edit_game_modal_open;
      EventBus.$emit("search", game_id);
    },
  },
};
</script>

<style lang="scss">
@import "../sass/Games.scss";
</style>
