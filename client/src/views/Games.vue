<template>
  <div>
    <Navbar />
    <div class="subheader">
      <h4 class="subheader-title" v-if="!phone">
        {{ current_filial.title }} ( {{ total_games }} )
      </h4>

      <div class="subheader-phone" v-if="phone">
        <div class="dropdown-variable">
          <div class="dropdown-variable-label menu-item">
            <h4 class="m-0">
              {{ current_filial.title }} ( {{ total_games }} )
            </h4>
            <font-awesome-icon class="ml-10" :icon="['fas', 'caret-down']" />
          </div>
          <div class="dropdown-content">
            <a
              v-for="(filial, index) in filials"
              v-bind:key="index"
              @click="changeFilial(filial)"
              >{{ filial.title }}</a
            >
          </div>
        </div>
      </div>

      <div class="search">
        <form>
          <input
            class="search-input"
            type="text"
            placeholder="Procure por um jogo aqui"
            aria-label="Search"
            v-model="search_query"
          />
          <button
            class="search-btn"
            @click="search()"
            v-if="!phone"
          >
            Procurar
          </button>
          <button
            class="search-btn"
            @click="search()"
            v-if="phone"
          >
            <font-awesome-icon class="button-icon" :icon="['fas', 'search']" />
          </button>
        </form>
      </div>
    </div>

    <!-- Advanced Search -->
    <form v-on:submit.prevent class="adv-search" v-show="adv_search">
      <div class="btn-close">
        <font-awesome-icon
          class="icon"
          :icon="['fas', 'times']"
          @click="adv_search = !adv_search"
        />
      </div>
      <div class="adv-search-form">
        <div class="select-container">
          <div class="form-group">
            <div class="label">
              <font-awesome-icon
                class="icon"
                :icon="['fab', 'creative-commons-by']"
              />
              <div class="divider-adv"></div>
              <label for="player-qtd" class="adv-serach-label-text">
                Nº de Jogadores</label
              >
            </div>
            <select
              id="player-qtd"
              class="dropdown-sm w-230"
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
              <div class="divider-adv"></div>
              <label for="language" class="adv-serach-label-text">Idioma</label>
            </div>
            <select
              id="language"
              class="dropdown-sm w-230"
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
            <div class="divider-adv"></div>
            <label class="adv-serach-label-text">Dificuldade</label>
          </div>
          <div class="form-check">
            <input
              class="form-check-input"
              id="dif-checkbox-1"
              type="checkbox"
              value="1"
              v-model="filter_difficulty"
            />
            <label class="form-check-label" for="dif-checkbox-1">
              Fácil
            </label>
          </div>
          <div class="form-check">
            <input
              class="form-check-input"
              id="dif-checkbox-2"
              type="checkbox"
              value="2"
              v-model="filter_difficulty"
            />
            <label class="form-check-label" for="dif-checkbox-2">
              Normal
            </label>
          </div>
          <div class="form-check">
            <input
              class="form-check-input"
              id="dif-checkbox-3"
              type="checkbox"
              value="3"
              v-model="filter_difficulty"
            />
            <label class="form-check-label" for="dif-checkbox-3">
              Intermediário
            </label>
          </div>
          <div class="form-check">
            <input
              class="form-check-input"
              id="dif-checkbox-4"
              type="checkbox"
              value="4"
              v-model="filter_difficulty"
            />
            <label class="form-check-label" for="dif-checkbox-4">
              Difícil
            </label>
          </div>
          <div class="form-check">
            <input
              class="form-check-input"
              id="dif-checkbox-5"
              type="checkbox"
              value="5"
              v-model="filter_difficulty"
            />
            <label class="form-check-label" for="dif-checkbox-5">
              Muito Difícil
            </label>
          </div>
        </div>

        <div class="form-group">
          <div class="label">
            <font-awesome-icon class="icon" :icon="['fas', 'cog']" />
            <div class="divider-adv"></div>
            <label for="genero" class="adv-serach-label-text">Gênero</label>
          </div>
          <div class="form-check">
            <input
              class="form-check-input"
              id="gen-checkbox-1"
              type="checkbox"
              value="1"
              v-model="filter_genre"
            />
            <label class="form-check-label" for="gen-checkbox-1">
              Festivo
            </label>
          </div>
          <div class="form-check">
            <input
              class="form-check-input"
              id="gen-checkbox-2"
              type="checkbox"
              value="2"
              v-model="filter_genre"
            />
            <label class="form-check-label" for="gen-checkbox-2">
              Infantil
            </label>
          </div>
          <div class="form-check">
            <input
              class="form-check-input"
              id="gen-checkbox-3"
              type="checkbox"
              value="3"
              v-model="filter_genre"
            />
            <label class="form-check-label" for="gen-checkbox-3">
              Família
            </label>
          </div>
          <div class="form-check">
            <input
              class="form-check-input"
              id="gen-checkbox-4"
              type="checkbox"
              value="4"
              v-model="filter_genre"
            />
            <label class="form-check-label" for="gen-checkbox-4">
              Estratégico
            </label>
          </div>
          <div class="form-check">
            <input
              class="form-check-input"
              id="gen-checkbox-5"
              type="checkbox"
              value="5"
              v-model="filter_genre"
            />
            <label class="form-check-label" for="gen-checkbox-5">
              Temático
            </label>
          </div>
        </div>
      </div>
      <div class="btn-container">
        <button class="sm-search-btn" @click="closeFilterPanel">
          Aplicar
        </button>
      </div>
    </form>
    <!-- End of Adv Search -->

    <div class="main-container">
      <div class="nav-filters-container">
        <!-- Navigation -->
        <nav aria-label="navigation" v-if="!phone">
          <ul class="pagination">
            <li>
              <button
                class="pg-btn pg-first btn-grey h-36"
                :disabled="!pagination.prev_page_url"
                @click="fetchGames(pagination.prev_page_url)"
              >
                Anterior
              </button>
            </li>
            <li class="pg-btn pg-middle btn-dark-grey h-36">
              {{
                pagination.last_page > 1
                  ? pagination.current_page + " de " + pagination.last_page
                  : "1 de 1"
              }}
            </li>
            <li>
              <button
                class="pg-btn pg-end btn-grey h-36"
                :disabled="!pagination.next_page_url"
                @click="fetchGames(pagination.next_page_url)"
              >
                Próximo
              </button>
            </li>
          </ul>
        </nav>
        <!-- End of Navigation -->

        <div class="dropdown-container">
          <div class="display-dropdown w-sm">
            <p class="dropdown-label" v-if="!phone">
              Exibir:
            </p>
            <select
              class="dropdown-sm w-175 h-36"
              id="sort-options"
              name="sort-options"
              v-model="display_qtd"
              v-on:change="fetchGames()"
            >
              <option value="12">12 jogos por página</option>
              <option value="24">24 jogos por página</option>
              <option value="48">48 jogos por página</option>
              <option value="96">96 jogos por página</option>
              <option value="192">192 jogos por página</option>
              <option value="todos">Todos os jogos</option>
            </select>
          </div>

          <div class="display-dropdown w-sm ml-10">
            <p class="dropdown-label" v-if="!phone">
              Odernar:
            </p>
            <select
              class="dropdown-sm w-175 h-36"
              id="sort-options"
              name="sort-options"
              v-model="sort_params"
              v-on:change="fetchGames()"
            >
              <option value="title asc">A-Z</option>
              <option value="title desc">Z-A</option>
              <option value="price asc">Menor Preço</option>
              <option value="price desc">Maior Preço</option>
              <option value="maxTime asc">Mais Curto</option>
              <option value="maxTime desc">Mais Longo</option>
            </select>
          </div>
        </div>
        <div class="btn-container">
          <button
            class="btn btn-grey h-36 w-sm"
            @click="adv_search = !adv_search"
          >
            Mais Filtros
          </button>
          <button class="btn btn-grey ml-10 h-36 w-sm" @click="clearFilter">
            Limpar Filtros
          </button>
        </div>
      </div>

      <div class="flex-container" v-if="total_games != 0">
        <div
          class="item item-public"
          v-for="game in games"
          v-bind:key="game.id"
        >
          <div
            class="item-container"
            v-bind:class="{ not_available: !game.isAvailable }"
          >
            <div class="left-container">
              <!-- Image thumb -->
              <div class="item-thumb-container">
                <div class="thumb-background">
                  <div class="thumb-size">
                    <div
                      class="item-thumb"
                      :style="{
                        backgroundImage: 'url(' + game.imageThumb + ')',
                      }"
                    ></div>
                  </div>
                </div>
              </div>
              <div class="button-container">
                <button
                  class="item-btn"
                  @click="sendMessage(game.title)"
                  v-bind:class="{ not_available: !game.isAvailable }"
                  :disabled="!game.isAvailable"
                >
                  {{ game.isAvailable ? "Alugar" : "Indisponível" }}
                </button>
              </div>
            </div>
            <!-- Info -->
            <div class="right-container">
              <!-- Title -->
              <div class="item-title">
                <h3 class="item-title-text">{{ game.title }}</h3>
              </div>
              <!-- Info -->
              <div class="item-info">
                <div class="info-row">
                  <div class="info-item">
                    <font-awesome-icon
                      class="icon"
                      :icon="['fab', 'creative-commons-by']"
                    />
                    <div class="divider-item"></div>
                    <p class="info-text info-text-normal">
                      {{
                        game.minPlayers === game.maxPlayers
                          ? game.minPlayers
                          : game.minPlayers + " a " + game.maxPlayers
                      }}
                    </p>
                  </div>
                  <div class="info-item">
                    <font-awesome-icon
                      class="icon"
                      :icon="['fas', 'book-reader']"
                    />
                    <div class="divider-item"></div>
                    <p class="info-text info-text-normal">
                      {{ game.difficulty.title }}
                    </p>
                  </div>
                </div>
                <div class="info-row">
                  <div class="info-item">
                    <font-awesome-icon class="icon" :icon="['far', 'clock']" />
                    <div class="divider-item"></div>
                    <p class="info-text info-text-normal">
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
                    <div class="divider-item"></div>
                    <p class="info-text info-text-normal">
                      {{ game.genre.title }}
                    </p>
                  </div>
                </div>
                <div class="info-row">
                  <div class="info-item">
                    <font-awesome-icon
                      class="icon thin-icon"
                      :icon="['fab', 'acquisitions-incorporated']"
                    />
                    <div class="divider-item"></div>
                    <p class="info-text info-text-normal">
                      {{ game.language.title }}
                    </p>
                  </div>
                  <div class="info-item">
                    <font-awesome-icon
                      class="icon money-icon"
                      :icon="['far', 'money-bill-alt']"
                    />
                    <div class="divider-item"></div>
                    <p class="info-text info-text-bold">R$ {{ game.price }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-else class="no-items-found">
        <p>Nenhum jogo encontrado.</p>
      </div>

      <!-- Navigation -->
      <div class="nav-filters-container">
        <nav aria-label="navigation">
          <ul class="pagination">
            <li>
              <button
                class="pg-btn pg-first btn-grey h-36"
                :disabled="!pagination.prev_page_url"
                @click="fetchGames(pagination.prev_page_url)"
              >
                Anterior
              </button>
            </li>
            <li class="pg-btn pg-middle btn-dark-grey h-36">
              {{
                pagination.last_page > 1
                  ? pagination.current_page + " de " + pagination.last_page
                  : "1 de 1"
              }}
            </li>
            <li>
              <button
                class="pg-btn pg-end btn-grey h-36"
                :disabled="!pagination.next_page_url"
                @click="fetchGames(pagination.next_page_url)"
              >
                Próximo
              </button>
            </li>
          </ul>
        </nav>
        <!-- End of Navigation -->
      </div>
    </div>
    <scroll-top></scroll-top>
    <Footer />
  </div>
</template>

<script>
import Navbar from "@/components/Navbar";
import Footer from "@/components/Footer";
import EventBus from "../main.js";
import Axios from "axios";
import { responsive } from "@/mixins/responsive";

export default {
  mixins: [responsive],

  components: {
    Navbar,
    Footer,
  },

  data() {
    return {
      //Filiais
      current_filial: {},
      filials: [],
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
      display_qtd: 12,
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

    this.fetchFilials();

    EventBus.$on("home", function() {
      vm.clearFilter();
    });

    EventBus.$on("changeFilial", function(payload) {
        vm.changeFilial(payload);
    });
  },

  methods: {
    fetchFilials(page_url) {
      page_url = page_url || "filials/all";

      Axios.get(page_url)
        .then((res) => {
          console.log("Fetch -> All Filials");
          this.filials = res.data;
          this.current_filial = this.filials[0];
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
        "games/filial=" +
          this.current_filial.id +
          "/sort=" +
          this.display_qtd +
          "&" +
          this.sort_target +
          "&" +
          this.sort_value +
          "/filter=" +
          this.filter_player_qtd +
          "&" +
          this.filter_language +
          "&" +
          string_difficulty +
          "&" +
          string_genre;

      Axios.get(page_url)
        .then((res) => {
          console.log("Fetch -> All Games");      
          vm.games = res.data.data;
          vm.total_games = res.data.meta.total;
          vm.makePagination(res.data.meta, res.data.links);
        })
        .catch((err) => console.log(err));
    },

    makePagination(meta, links) {
      if (links.next) {
        links.next = links.next.replace("http", "https");
      }

      if (links.prev) {
        links.prev = links.prev.replace("http", "https");
      }

      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev,
      };
      console.log("Make -> Pagination");
      this.pagination = pagination;
    },

    search(page_url) {
      let vm = this;
      let regex = /^[a-zA-Z0-9\s]*$/;
      let query = "";

      if (regex.test(this.search_query)) {
        query = this.search_query.split(" ").join("%20");
      } else {
        alert("Parâmetros de busca inválidos.");
        return;
      }

      this.search_query = "";

      page_url =
        page_url ||
        "games/filial=" +
          this.current_filial.id +
          "/sort=" +
          this.display_qtd +
          "&" +
          this.sort_target +
          "&" +
          this.sort_value +
          "/search=" +
          query;

      Axios.get(page_url)
        .then((res) => {
          console.log("Fetch -> Search");
          vm.games = res.data.data;
          vm.total_games = res.data.meta.total;
          vm.makePagination(res.data.meta, res.data.links);
        })
        .catch((err) => console.log(err));
    },

    sendMessage(title) {
      let message = "Olá! Gostaria de alugar o jogo " + title;
      let formatedMessage = message.split(" ").join("%20");
      let url =
        "https://wa.me/5555" + this.contact + "?text=" + formatedMessage;
      window.open(url, "_blank");
    },

    changeFilial(filial) {
      console.log("Change -> Filial");
      this.current_filial = filial;
      this.clearFilter();
    },

    closeFilterPanel() {
      console.log("Close -> Filter Panel");
      this.fetchGames();
      this.adv_search = !this.adv_search;
    },

    clearFilter() {
      console.log("Clear -> Filters");
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
