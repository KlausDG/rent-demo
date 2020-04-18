<template>
  <div class="go-top" v-show="displayButton" v-scroll-to="'#app'"></div>
</template>

<script>
export default {
  data() {
    return {
      displayButton: false,
      lastScrollPosition: 0,
    };
  },

  mounted() {
    window.addEventListener("scroll", this.onScroll);
  },

  beforeDestroy() {
    window.removeEventListener("scroll", this.onScroll);
  },

  methods: {
    onScroll() {
        const currentScrollPosition =
        window.pageYOffset || document.documentElement.scrollTop;
      this.displayButton = currentScrollPosition > 10
    },
  },
};
</script>

<style lang="scss" scoped>
@import "../sass/Main.scss";

.go-top {
  position: fixed;
  right: 75px;
  bottom: 25px;
  z-index: 1000;
  @include size(50px, 50px);
  @include backgroundImage(Auto, 100%, true);
  background-image: url("../assets/images/arrow.svg");
}
</style>
