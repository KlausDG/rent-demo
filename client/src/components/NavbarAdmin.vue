<template>
  <div>
    <!-- HEADER -->
    <nav class="navbar header">
      <div class="nav-item-one">
        <a href="#" class="navbar-brand" @click="home">LendsGames DEMO - Admin</a>
      </div>
    </nav>
    <!-- FIM HEADER -->
  </div>
</template>

<style lang="scss">
@import "../sass/Navbar.scss";
</style>

<script>
import EventBus from "../main.js";

export default {

    methods: {
      home() {
        EventBus.$emit("home", "");
      },
    },
};
</script>
