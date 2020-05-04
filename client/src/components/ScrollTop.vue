<template>
  <div class="go-top-container" v-show="displayButton" v-scroll-to="'#app'">
    <div class="go-top"></div>
  </div>
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
