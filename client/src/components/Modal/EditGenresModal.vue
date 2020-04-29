<template>
  <div class="modal-background" v-show="value">
    <div class="modal vertical-modal">
      <div class="modal-header">
        <div class="modal-title-container">
          <p class="title">Gêneros</p>
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
            v-for="(genre, index) in genres"
            v-bind:key="index"
          >
            <div class="index-label">{{ index + 1 }} -</div>
            <input
              type="text"
              name="title"
              class="form-input"
              v-model="genres[index].title"
              required
            />
            <div class="item-submit">
              <button
                type="submit"
                class="btn btn-green ml-10"
                @click.prevent="edit(genres[index])"
              >
                Salvar
              </button>
              <button
                type="submit"
                class="btn btn-red ml-10"
                @click.prevent="remove(genre.id)"
              >
                Deletar
              </button>
            </div>
          </div>

          <div class="divider-modal"></div>

          <div class="form-group">
            <div class="index-label">{{ genres.length + 1 }} -</div>
              <input
                type="text"
                name="title"
                class="form-control form-input"
                v-model="newGenre.title"
                placeholder="Adicionar novo gênero"
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

export default {
  name: "genresModal",

  data() {
    return {
      newGenre: {
        title: "",
      },
      genres: [],
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
    this.resp = "";
    this.fetch();
  },

  methods: {
    close() {
      this.$emit("input", !this.value);
    },

    fetch() {
      let vm = this;

      Axios.get("genres/all")
        .then((res) => {
          vm.genres = res.data;
        })
        .catch((err) => console.log(err));
    },

    add() {
      this.has_error = false;
      let vm = this;
      Axios.post("genres/add", this.newGenre)
        .then((res) => {
          vm.resp = "Gênero " + res.data.title + " adicionado com sucesso!";
          vm.newGenre.title = "";
          vm.fetch();
        })
        .catch((err) => console.log(err));
    },

    async edit(dif) {
      this.has_error = false;
      let vm = this;
      await Axios.put("genres/edit", dif)
        .then((res) => {
          vm.resp =
            "Gênero " +
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
      this.genres.forEach(async (element) => {
        await Axios.put("genres/edit", element).catch((err) => {
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
      await Axios.delete("genres/gen=" + id)
        .then((res) => {
          vm.resp = "Gênero " + res.data.title + " removido com sucesso!";
        })
        .catch((err) => console.log(err));

      this.fetch();
    },
  },
};
</script>
