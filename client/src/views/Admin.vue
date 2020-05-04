<template>
  <div>
    <NavbarAdmin />
    <div class="subheader">
      <h4 class="subheader-title" v-if="!phone">
        {{
          filter_filial != "all"
            ? filials[filter_filial - 1].title
            : "Todos os Jogos"
        }}
        ( {{ total_games }} )
      </h4>
      <div class="search" v-bind:class="{ 'mb-10': phone, 'mt-10': phone }">
        <form v-on:submit.prevent="search()">
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
            v-if="window.width > screen.phone"
          >
            Procurar
          </button>
          <button
            class="search-btn"
            @click="search()"
            v-if="window.width <= screen.phone"
          >
            <font-awesome-icon class="button-icon" :icon="['fas', 'search']" />
          </button>
        </form>
      </div>
    </div>

    <div class="main-container">
      <div class="nav-filters-container" v-bind:class="{ 'bg-secondary': phone }">
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

        <div class="dropdown-container" v-bind:class="{ 'flex-wrap': phone }">
          <div class="display-dropdown">
            <p class="dropdown-label">
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

          <div class="display-dropdown" v-if="!phone">
            <p class="dropdown-label">
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
          <div class="display-dropdown">
            <p class="dropdown-label">
              Jogos:
            </p>
            <select
              class="dropdown-sm w-175 h-36"
              id="sort-options"
              name="sort-options"
              v-model="filter_games"
              v-on:change="fetchGames()"
            >
              <option value="all">Todos</option>
              <option value="0">Jogos Alugados</option>
              <option value="1">Jogos Disponíveis</option>
            </select>
          </div>
          <div class="display-dropdown">
            <p class="dropdown-label">
              Filiais:
            </p>
            <select
              class="dropdown-sm w-175 h-36"
              id="sort-options"
              name="sort-options"
              v-model="filter_filial"
              v-on:change="fetchGames()"
            >
              <option value="all">Todas</option>
              <option
                v-for="(filial, index) in filials"
                v-bind:value="filial.id"
                v-bind:key="index"
                >{{ filial.title }}</option
              >
            </select>
          </div>
          <div :class="{'btn-container-admin': phone, 'btn-container': !phone}">
            <button class="btn btn-grey h-36" @click="clearFilter" :class="{'ml-10': !phone}">
              Limpar Busca
            </button>
          </div>
        </div>
      </div>
      <div class="sm-title-contaier" v-if="phone">
        <h4 class="sm-title">
          {{
            filter_filial != "all"
              ? filials[filter_filial - 1].title
              : "Todos os Jogos"
          }}
          ( {{ total_games }} )
        </h4>
      </div>
      <div class="flex-container" v-if="total_games != 0">
        <div class="item item-admin" v-for="game in games" v-bind:key="game.id">
          <div
            class="item-container"
            v-bind:class="{ not_available_admin: !game.isAvailable }"
          >
            <div class="left-container">
              <!-- Image -->
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
                <button class="item-btn" @click="openEditModal(game.id)">
                  Editar
                </button>
              </div>
            </div>
            <!-- Info -->
            <div class="right-container">
              <!-- Title -->
              <div class="item-title">
                <h3 class="item-title-text">{{ game.title }}</h3>
              </div>
              <!-- Items -->
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
                    <p class="info-text info-text-bold">
                      <span>R$ {{ game.price }}</span>
                    </p>
                  </div>
                </div>

                <div class="info-row">
                  <div class="info-item">
                    <font-awesome-icon
                      class="icon globe-icon"
                      :icon="['fas', 'globe-americas']"
                    />
                    <div class="divider-item"></div>
                    <p class="info-text info-text-normal">
                      {{ game.filial.title }}
                    </p>
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
      </div>
      <!-- End of Navigation -->
    </div>
    <Footer />
    <edit-game-modal v-model="edit_game_modal_open"></edit-game-modal>
    <scroll-top></scroll-top>
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
      filials: [],
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

      display_qtd: 12,
      //Searching
      search_query: "",
      //Sorting
      sort_params: "title asc",
      sort_target: "",
      sort_value: "",
      //Filtering
      filter_games: "all",
      filter_filial: "all",
      //Other
      edit_game_modal_open: false,
      contact: "981432111",
      //Media Queries
      window: {
        width: 0,
        height: 0,
      },
      screen: {
        phone: 767.98,
        tablet: 991.98,
      },
    };
  },

  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user",
    }),

    phone() {
      return this.window.width <= this.screen.phone;
    },
  },

  created() {
    let vm = this;

    window.addEventListener("resize", this.handleResize);
    this.handleResize();

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

      page_url = page_url || "filials/all";

      Axios.get(page_url)
        .then((res) => {
          vm.filials = res.data;
          console.log("Fetch -> Filials");
          this.fetchGames();
        })
        .catch((err) => console.log(err));
    },

    fetchGames(page_url) {
      let vm = this;

      this.sort_target = this.sort_params.split(" ")[0];
      this.sort_value = this.sort_params.split(" ")[1];

      page_url =
        page_url ||
        "games/admin/filial=" +
          this.filter_filial +
          "/sort=" +
          this.display_qtd +
          "&" +
          this.sort_target +
          "&" +
          this.sort_value +
          "/filter=" +
          this.filter_games;

      Axios.get(page_url)
        .then((res) => {
          console.log("Fetch -> Games");
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
        Axios.post(`games/game=${id}`, {
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
        "games/filial=" +
          this.filter_filial +
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
          vm.games = res.data.data;
          vm.total_games = res.data.meta.total;
          vm.makePagination(res.data.meta, res.data.links);
        })
        .catch((err) => console.log(err));
    },

    selectFilial(e) {
      this.filter_filial = e.currentTarget.id.split("_")[1];
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
      this.filter_games = "all";
      this.filter_filial = "all";
      this.search_query = "";
      this.fetchGames();
    },

    openEditModal(game_id) {
      this.edit_game_modal_open = !this.edit_game_modal_open;
      EventBus.$emit("search", game_id);
    },

    handleResize() {
      this.window.width = window.innerWidth;
      this.window.height = window.innerHeight;
    },
  },
};
</script>
