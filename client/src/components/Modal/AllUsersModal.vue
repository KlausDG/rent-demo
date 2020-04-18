<template>
  <div class="modal-backdrop" v-show="value">
    <div class="modal-main">
      <div class="title-container">
        <div class="modal-title">
          <p class="title">Sócios</p>
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
      <div class="modal-container">
        <form>
          <div class="flex-container">
            <div
              class="form-group"
              v-for="(user, index) in users"
              v-bind:key="index"
            >
              <div class="title-label">
                <p>{{ index + 1 }} -</p>
              </div>
              <div class="input-container">
                <input
                  type="text"
                  name="title"
                  class="form-control form-input"
                  v-model="users[index].name"
                  disabled
                />
              </div>
              <div class="item-submit">
                <button
                  type="submit"
                  class="btn btn-success"
                  @click.prevent="editUser(users[index])"
                >
                  Editar
                </button>
                <button
                  type="submit"
                  class="btn btn-danger"
                  @click.prevent="remove(user.id)"
                >
                  Deletar
                </button>
              </div>
            </div>

            <div class="divider"></div>
          </div>
          <div class="result-message" v-bind:class="{ error: has_error }">
            <p>{{ resp }}</p>
          </div>
          <div class="custom-btn d-flex justify-content-center pb-4">
            <button
              type="submit"
              class="btn btn-primary"
              @click.prevent="newUser"
            >
              Cadastrar Novo Sócio
            </button>
          </div>
        </form>
      </div>
    </div>
    <edit-user-modal v-model="edit_user_modal_open"></edit-user-modal>
  </div>
</template>

<script>
import EventBus from "@/main.js";
import Axios from "axios";

export default {
  name: "usersModal",

  data() {
    return {
      users: [],
      resp: "",
      has_error: false,
      edit_user_modal_open: false,
    };
  },

  props: {
    value: {
      required: true,
    },
  },

  created() {
    this.fetch();
  },

  methods: {
    close() {
      this.$emit("input", !this.value);
    },

    fetch() {
      let vm = this;

      Axios.get("users/all")
        .then((res) => {
          vm.users = res.data;
        })
        .catch((err) => console.log(err));
    },

    async editUser(usr) {
      this.edit_user_modal_open = !this.edit_user_modal_open;
      EventBus.$emit("searchUser", usr);
    },

    async remove(id) {
      this.has_error = false;
      let vm = this;
      await Axios.delete("users/usr=" + id)
        .then((res) => {
          vm.resp = "Sócio " + res.data.title + " removido com sucesso!";
        })
        .catch((err) => console.log(err));

      this.fetch();
    },

    newUser() {
      this.$emit("addUser");
      this.close();
    },
  },
};
</script>

<style lang="scss" scoped>
@import "@/sass/ListModal.scss";
</style>
