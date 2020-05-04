<template>
  <div class="modal-background" v-show="value">
    <div class="modal horizontal-modal">
      <div class="modal-header">
        <div class="modal-title-container">
          <p class="title">Edição de Loja</p>
        </div>
        <div class="btn-close-modal">
          <font-awesome-icon :icon="['fas', 'times']" @click="close" />
        </div>
        <div class="divider-modal"></div>
      </div>

      <div class="modal-body">
        <form class="horizontal-form form-grid">
          <div class="form-group" :class="{ 'flex-col-12': !phone }">
            <label for="title" class="title-label">Título</label>
            <input
              type="text"
              name="title"
              class="form-input"
              v-model="filial.title"
              required
            />
          </div>

          <div class="form-group flex-col-4" v-if="!phone">
            <label for="price" class="title-label">Rua</label>
            <input
              type="text"
              name="rua"
              class="form-input"
              v-model="filial.rua"
              required
            />
          </div>

          <div class="form-group flex-col-1" v-if="!phone">
            <label for="image" class="title-label">Nº</label>
            <input
              type="text"
              name="numero"
              class="form-input"
              v-model="filial.numero"
              required
            />
          </div>

          <div class="form-group-row" v-if="phone">
            <div class="form-group">
              <label for="price" class="title-label">Rua</label>
              <input
                type="text"
                name="rua"
                class="form-input"
                v-model="filial.rua"
                required
              />
            </div>

            <div class="form-group">
              <label for="image" class="title-label">Nº</label>
              <input
                type="text"
                name="numero"
                class="form-input"
                v-model="filial.numero"
                required
              />
            </div>
          </div>

          <div class="form-group flex-col-2" v-if="!phone">
            <label for="obslang" class="title-label">Bairro</label>
            <input
              type="text"
              name="bairro"
              class="form-input"
              v-model="filial.bairro"
              required
            />
          </div>

          <div class="form-group flex-col-2" v-if="!phone">
            <label for="image" class="title-label">Cidade</label>
            <input
              type="text"
              name="cidade"
              class="form-input"
              v-model="filial.cidade"
              required
            />
          </div>

          <div class="form-group-row" v-if="phone">
            <div class="form-group">
              <label for="obslang" class="title-label">Bairro</label>
              <input
                type="text"
                name="bairro"
                class="form-control form-input"
                v-model="filial.bairro"
                required
              />
            </div>

            <div class="form-group">
              <label for="image" class="title-label">Cidade</label>
              <input
                type="text"
                name="cidade"
                class="form-control form-input"
                v-model="filial.cidade"
                required
              />
            </div>
          </div>

          <div class="form-group flex-col-1" v-if="!phone">
            <label for="image" class="title-label">UF</label>
            <input
              type="text"
              name="uf"
              class="form-input"
              v-model="filial.uf"
              required
            />
          </div>

          <div class="form-group flex-col-2" v-if="!phone">
            <label for="image" class="title-label">País</label>
            <input
              type="text"
              name="pais"
              class="form-input"
              v-model="filial.pais"
              required
            />
          </div>

          <div class="form-group-row" v-if="phone">
            <div class="form-group">
            <label for="image" class="title-label">UF</label>
            <input
              type="text"
              name="uf"
              class="form-control form-input"
              v-model="filial.uf"
              required
            />
          </div>

          <div class="form-group">
            <label for="image" class="title-label">País</label>
            <input
              type="text"
              name="pais"
              class="form-control form-input"
              v-model="filial.pais"
              required
            />
          </div>
          </div>

          <div class="form-group flex-col-2">
            <label for="image" class="title-label">Cep</label>
            <input
              type="text"
              name="cep"
              class="form-input"
              v-model="filial.cep"
              required
            />
          </div>

          <div class="form-group flex-col-3">
            <label for="image" class="title-label">Complemento</label>
            <input
              type="text"
              name="complemento"
              class="form-input"
              v-model="filial.complemento"
            />
          </div>

          <div class="form-group flex-col-4">
            <label for="image" class="title-label">Ponto de Referência</label>
            <input
              type="text"
              name="referencia"
              class="form-input"
              v-model="filial.referencia"
            />
          </div>

          <div class="form-group flex-col-3">
            <label class="title-label">Telefone</label>
            <input
              type="text"
              class="form-input"
              name="phone"
              v-model="filial.phone"
              required
            />
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-blue form-btn" @click="formatData">
          Salvar
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
  name: "EditFilialModal",
  mixins: [responsive],

  data() {
    return {
      filial: {
        id: "",
        title: "",
        phone: "",
        rua: "",
        bairro: "",
        numero: "",
        cidade: "",
        uf: "",
        pais: "",
        cep: "",
        complemento: "",
        referencia: "",
      },
    };
  },

  props: {
    value: {
      required: true,
    },
  },

  created() {
    let vm = this;
    EventBus.$on("searchFilial", function(payload) {
      vm.filial = payload;
    });
  },

  methods: {
    close() {
      this.$emit("input", !this.value);
    },

    formatData() {
      //Remove non number characters
      this.filial.phone = this.filial.phone.replace(/\D/g, "");
      this.filial.numero = this.filial.numero.replace(/\D/g, "");
      this.filial.cep = this.filial.cep.replace(/\D/g, "");

      //To Upper
      this.filial.uf = this.filial.uf.toUpperCase();

      //Capitalize
      this.filial.title = this.capitalize(this.filial.title);
      this.filial.rua = this.capitalize(this.filial.rua);
      this.filial.bairro = this.capitalize(this.filial.bairro);
      this.filial.cidade = this.capitalize(this.filial.cidade);
      this.filial.pais = this.capitalize(this.filial.pais);

      this.editFilial();
    },

    editFilial() {
      Axios.put("filials/edit", this.filial)
        .then((res) => {
          alert("Filial " + res.data.id + " alterada com sucesso!");
        })
        .catch((err) => console.log(err));

      this.close();
    },

    capitalize(str) {
      return str.replace(/(?:^|\s)\S/g, function(a) {
        return a.toUpperCase();
      });
    },
  },
};
</script>
