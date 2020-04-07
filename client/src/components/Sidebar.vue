<template lang="html">
  <div id="parentx">
    <!-- <vs-button @click="active=!active" color="primary" type="filled">Open Sidebar</vs-button> -->
    <vs-sidebar
      parent="body"
      default-index="1"
      color="primary"
      class="sidebarx"
      spacer
      v-model="active"
    >
      <div class="header-sidebar" slot="header">
        <vs-avatar
          size="150px"
          src="https://randomuser.me/api/portraits/men/85.jpg"
        />

        <h4>
          Klaus Dieter Galm
        </h4>
      </div>

      <vs-sidebar-item index="1" icon="add">
        Adicionar Jogo
      </vs-sidebar-item>

      <vs-divider></vs-divider>

      <vs-sidebar-group title="Exibir">
        <vs-sidebar-item index="2.1" icon="play_arrow">
          Todos os Jogos
        </vs-sidebar-item>
        <vs-sidebar-item index="2.2" icon="play_arrow">
          Jogos Alugados
        </vs-sidebar-item>
        <vs-sidebar-item index="2.3" icon="play_arrow">
          Jogos Disponíveis
        </vs-sidebar-item>
      </vs-sidebar-group>

      <vs-divider></vs-divider>

      <vs-sidebar-item index="5" icon="verified_user">
        Editar Perfil
      </vs-sidebar-item>
      <vs-sidebar-item index="5" icon="verified_user">
        Editar Filial
      </vs-sidebar-item>
      <vs-sidebar-item index="6" icon="account_box">
        Alterar Senha
      </vs-sidebar-item>

      <div class="footer-sidebar" slot="footer">
        <vs-button icon="reply" color="danger" type="flat">Sair</vs-button>
      </div>
    </vs-sidebar>
  </div>
</template>

<script>
export default {
  data: () => ({
    active: true,
  }),
};
</script>

<style lang="scss">
.header-sidebar {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  width: 100%;
}
  h4 {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    button{
      margin-left: 10px;

    }

  }
.footer-sidebar{
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  button {
      border: 0px solid rgba(0,0,0,0) !important;
      border-left: 1px solid rgba(0,0,0,.07) !important;
      border-radius: 0px !important;;
  }

}
</style>
