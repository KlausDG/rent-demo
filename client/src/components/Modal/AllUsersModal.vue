<template>
  <div class="modal-background" v-show="value">
    <div class="modal vertical-modal">
      <div class="modal-header">
        <div class="modal-title-container">
          <p class="title">Usuários</p>
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
            v-for="(user, index) in users"
            v-bind:key="index"
          >
            <div class="index-label" v-if="!phone">{{ index + 1 }} -</div>
            <input
              type="text"
              name="title"
              class="form-input"
              v-model="users[index].name"
              disabled
            />
            <div class="item-submit">
              <button
                type="submit"
                class="btn btn-green"
                :class="{ 'btn-sm': phone, 'ml-10': !phone }"
                @click.prevent="editUser(users[index])"
              >
                Editar
              </button>
              <button
                type="submit"
                class="btn btn-red"
                :class="{ 'btn-sm': phone, 'ml-10': !phone }"
                @click.prevent="remove(user.id)"
              >
                Deletar
              </button>
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
          @click.prevent="newUser"
        >
          Novo Usuário
        </button>
      </div>
    </div>
    <edit-user-modal v-model="edit_user_modal_open"></edit-user-modal>
  </div>
</template>

<script>
import EventBus from "@/main.js";
import Axios from "axios";
import { responsive } from "@/mixins/responsive";

export default {
  name: "usersModal",
  mixins: [responsive],

  data() {
    return {
      users: [],
      resp: "",
      has_error: false,
      edit_user_modal_open: false,
    };
  },

  watch: {
    value: function() {
      if (this.value != false) {
        this.fetch();
      }
    },
  },

  props: {
    value: {
      required: true,
    },
  },

  created() {
    this.resp = "";
  },

  methods: {
    close() {
      this.$emit("input", !this.value);
    },

    fetch() {
      let vm = this;

      Axios.get("users/all")
        .then((res) => {
          console.log("Fetch -> All Users");
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
        .then(() => {
          vm.resp = "Usuário removido com sucesso!";
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
