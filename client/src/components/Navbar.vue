<template>
    <div>
        <!-- HEADER -->
        <nav class="navbar header">
            <div class="nav-item-one">
                <a href="#" class="navbar-brand" @click="home"
                    >LendsGames DEMO</a
                >
            </div>
            <div class="nav-item-two">
                <a
                    href="#"
                    class="navbar-brand"
                    v-for="filial in filials"
                    :key="filial.id"
                    @click="changeFilial(filial)"
                    v-bind:class="[{ selected: current_selected == filial.id }]"
                    >{{ filial.title }}</a
                >

                <i class="fas fa-user-lock fa-lg" @click="openModal"></i>
                <!-- <i class="fas fa-user-lock fa-lg" data-toggle="modal" data-target="#modalLoginForm"></i> -->
            </div>
        </nav>
        <!-- FIM HEADER -->

        <!-- Login Modal -->
        <login-modal v-model="login_modal_open"></login-modal>
    </div>
</template>

<style lang="scss">
@import "../sass/Navbar.scss";
</style>

<script>
import EventBus from "../main.js";
export default {
    data() {
        return {
            filials: [],
            current_selected: 1,
            login_modal_open: false
        };
    },
    created() {
        this.fetchFilials();
    },
    methods: {
        home() {
            EventBus.$emit("home", "");
        },
        openModal() {
            this.login_modal_open = !this.login_modal_open;
        },
        changeFilial(filial) {
            this.current_selected = filial.id;
            EventBus.$emit("changeFilial", filial);
        },
        fetchFilials(page_url) {
            let vm = this;

            page_url = page_url || "api/filials";

            fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.filials = res;
                    vm.changeFilial(this.filials[0]);
                })
                .catch(err => console.log(err));
        }
    }
};
</script>
