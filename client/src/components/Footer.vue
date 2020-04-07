<template>
  <div class="footer-container">
    <p>
      &nbsp;
      <span>Copyright &copy; 2020.</span>
      <span> Klaus D. Galm.</span>
    </p>
  </div>
</template>

<style lang="scss" scoped>
@import "../sass/Main.scss";

.footer-container {
  @include size(100%, 80px);
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: $main_color_2;

  p {
    margin: 0;
    font-size: $font_size_important;
  }
}
</style>
