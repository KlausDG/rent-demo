<template>
  <div class="modal-backdrop" v-show="value">
    <div class="add-game-modal">
      <div class="modal-container">
        <div class="modal-title">
          <p class="title">Cadastro de Filial</p>
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
        <form @submit.prevent="formatData">
          <div class="row">
            <div class="form-group col-md-5">
              <label for="title" class="title-label">Título</label>
              <input
                type="text"
                name="title"
                class="form-control form-input"
                v-model="filial.title"
                required
              />
            </div>

            <div class="form-group col-md-2">
              <label class="title-label">Telefone</label>
              <input
                type="text"
                class="form-control form-input"
                name="phone"
                v-model="filial.phone"
                required
              />
            </div>

            <div class="form-group col-md-4">
              <label for="price" class="title-label">Rua</label>
              <input
                type="text"
                name="rua"
                class="form-control form-input"
                v-model="filial.rua"
                required
              />
            </div>

            <div class="form-group col-md-1">
              <label for="image" class="title-label">Nº</label>
              <input
                type="text"
                name="numero"
                class="form-control form-input"
                v-model="filial.numero"
                required
              />
            </div>

            <div class="form-group col-md-3">
              <label for="obslang" class="title-label">Bairro</label>
              <input
                type="text"
                name="bairro"
                class="form-control form-input"
                v-model="filial.bairro"
                required
              />
            </div>

            <div class="form-group col-md-3">
              <label for="image" class="title-label">Cidade</label>
              <input
                type="text"
                name="cidade"
                class="form-control form-input"
                v-model="filial.cidade"
                required
              />
            </div>

            <div class="form-group col-md-1">
              <label for="image" class="title-label">UF</label>
              <input
                type="text"
                name="uf"
                class="form-control form-input"
                v-model="filial.uf"
                required
              />
            </div>

            <div class="form-group col-md-2">
              <label for="image" class="title-label">País</label>
              <input
                type="text"
                name="pais"
                class="form-control form-input"
                v-model="filial.pais"
                required
              />
            </div>

            <div class="form-group col-md-3">
              <label for="image" class="title-label">Cep</label>
              <input
                type="text"
                name="cep"
                class="form-control form-input"
                v-model="filial.cep"
                required
              />
            </div>

            <div class="form-group col-md-6">
              <label for="image" class="title-label">Complemento</label>
              <input
                type="text"
                name="complemento"
                class="form-control form-input"
                v-model="filial.complemento"
              />
            </div>

            <div class="form-group col-md-6">
              <label for="image" class="title-label">Ponto de Referência</label>
              <input
                type="text"
                name="referencia"
                class="form-control form-input"
                v-model="filial.referencia"
              />
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
import Axios from "axios";

export default {
  name: "AddFilialModal",

  data() {
    return {
      filial: {
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

      this.addFilial();
    },

    addFilial() {
      Axios.post("filial", this.filial)
        .then((res) => {
          alert("Filial adicionada com sucesso!");
          console.log(res);
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

<style lang="scss" scoped>
@import "@/sass/AddGameModal.scss";
</style>
