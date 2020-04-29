<template>
  <div class="modal-background" v-show="value">
    <div class="modal vertical-modal">
      <div class="modal-header">
        <div class="modal-title-container">
          <p class="title">Alterar Senha</p>
        </div>
        <div class="btn-close-modal">
          <font-awesome-icon :icon="['fas', 'times']" @click="close" />
        </div>
        <div class="divider-modal"></div>
      </div>

      <div class="modal-body">
        <form class="vertical-form mb-20">

          <div class="form-group">
            <label for="old_password" class="title-label">Senha Antiga</label>
            <input
              type="password"
              name="old_password"
              class="form-input"
              placeholder="Senha antiga"
              v-model="me.old_password"
              required
            />
          </div>

          <div class="form-group">
            <label for="password" class="title-label">Senha Nova</label>
            <input
              type="password"
              name="password"
              class="form-input"
              placeholder="Nova senha"
              v-model="me.password"
              required
            />
          </div>

          <div class="form-group">
            <label for="v_password" class="title-label"
              >Confirmação de Senha</label
            >
            <input
              type="password"
              name="v_password"
              class="form-input"
              placeholder="Repetir nova senha"
              v-model="me.v_password"
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
import Axios from "axios";
import { mapGetters } from "vuex";

export default {
  name: "EditProfileModal",

  data() {
    return {
      me: {
        id: "",
        old_password: "",
        password: "",
        v_password: "",
      },
      confirm_old_password: "",
    };
  },

  props: {
    value: {
      required: true,
    },
  },

  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user",
    }),
  },

  created() {
    this.me.id = this.user.id;
    this.confirm_old_password = this.user.password;
  },

  methods: {
    close() {
      this.$emit("input", !this.value);
    },

    formatData() {
      if (this.me.password !== this.me.v_password) {
        alert("As senhas inseridas são diferentes!");
        return;
      }

      this.editMe();
    },

    editMe() {
      Axios.put("users/edit", this.me)
        .then((res) => {
          res.data.error
            ? alert(res.data.error)
            : alert("Senha alterada com sucesso!");
        })
        .catch((err) => console.log(err));

      this.close();
    },
  },
};
</script>
