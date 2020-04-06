<template>
    <div v-show="displayButton">
        <i class="fas fa-angle-double-up" v-scroll-to="'#app'"></i>
    </div>
</template>

<style lang="scss" scoped>
@import "../sass/Main.scss";

i {
    position: fixed;
    right: 75px;
    bottom: 50px;
    color: $main_color_1;
    font-size: $font_size_title;
}
</style>

<script>
export default {
    data() {
        return {
            displayButton: false,
            lastScrollPosition: 0
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
            if (currentScrollPosition < 0) {
                return;
            }
            if (
                Math.abs(currentScrollPosition - this.lastScrollPosition) < 60
            ) {
                return;
            }
            this.displayButton =
                currentScrollPosition > this.lastScrollPosition;
            this.lastScrollPosition = currentScrollPosition;
        }
    }
};
</script>
