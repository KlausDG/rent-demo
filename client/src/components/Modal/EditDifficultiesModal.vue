<template>
  <div class="modal-background" v-show="value">
    <div class="modal vertical-modal">
      <div class="modal-header">
        <div class="modal-title-container">
          <p class="title">Dificuldades</p>
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
            v-for="(difficulty, index) in difficulties"
            v-bind:key="index"
          >
            <div class="index-label">{{ index + 1 }} -</div>
            <input
              type="text"
              name="title"
              class="form-input"
              v-model="difficulties[index].title"
              required
            />
            <div class="item-submit">
              <button
                type="submit"
                class="btn btn-green ml-10"
                @click.prevent="edit(difficulties[index])"
              >
                Salvar
              </button>
              <button
                type="submit"
                class="btn btn-red ml-10"
                @click.prevent="remove(difficulty.id)"
              >
                Deletar
              </button>
            </div>
          </div>

          <div class="divider-modal"></div>

          <div class="form-group">
            <div class="index-label">{{ difficulties.length + 1 }} -</div>
              <input
                type="text"
                name="title"
                class="form-control form-input"
                v-model="newDifficulty.title"
                placeholder="Nova dificuldade"
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
        <button type="submit" class="btn btn-blue form-btn" @click.prevent="editAll">
          Salvar Todos
        </button>
      </div>
    </div>
  </div>
</template>

<script>
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
    this.resp = "";
    this.fetch();
  },

  methods: {
    close() {
      this.$emit("input", !this.value);
    },

    fetch() {
      let vm = this;

      Axios.get("difficulties/all")
        .then((res) => {
          vm.difficulties = res.data;
        })
        .catch((err) => console.log(err));
    },

    add() {
      this.has_error = false;
      let vm = this;
      Axios.post("difficulties/add", this.newDifficulty)
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
      await Axios.put("difficulties/edit", dif)
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
        await Axios.put("difficulties/edit", element).catch((err) => {
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
      await Axios.delete("difficulties/dif=" + id)
        .then((res) => {
          vm.resp = "Dificuldade " + res.data.title + " removida com sucesso!";
        })
        .catch((err) => console.log(err));

      this.fetch();
    },
  },
};
</script>
