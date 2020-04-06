<template>
    <!-- <div class="modal-backdrop" v-show="value"> -->
    <div class="modal-backdrop" v-show="value">
        <div class="login-modal">
            <div class="modal-container">
                <div class="modal-title">
                    <p class="title">Área Restrita</p>
                    <p class="modal-subtitle">
                        Acesso somente para administradores.
                    </p>
                </div>
                <div class="btn-close">
                    <i class="fas fa-times" @click="close"></i>
                </div>
            </div>
            <form action="">
                <div class="form-group">
                    <input type="text" name="username" placeholder="Usuário" v-model="username" required/>
                </div>
                <div class="form-group">
                    <input type="password" name="pwd" placeholder="Senha" v-model="password" required/>
                </div>
                
                <button
                    type="button"
                    class="btn btn-primary custom-btn"
                    @click="login"
                >
                    Entrar
                </button>
                <p v-if="has_error">Usuário ou senha inválidos.</p>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "LoginModal",
    data() {
        return {
            username: null,
            password: null,
            has_error: false,
        };
    },
    props: {
        value: {
            required: true,
        },
    },
    methods: {
        close() {
            this.$emit("input", !this.value);
        },

        login() {
            // get the redirect object
            var redirect = this.$auth.redirect();
            var app = this;
            this.$auth.login({
                params: {
                    username: app.username,
                    password: app.password,
                },
                success: function () {
                    // handle redirection
                    const redirectTo = redirect
                        ? redirect.from.name
                        : this.$auth.user().role === 2
                        ? "admin.games"
                        : "games";

                    this.$router.push({ name: redirectTo });
                },
                error: function () {
                    app.has_error = true;
                },
                rememberMe: true,
                fetchUser: true,
            });
        },
    },
};
</script>

<style lang="scss" scoped>
@import "../sass/Main.scss";

.modal-backdrop {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0);
    display: flex;
    justify-content: center;
    align-items: center;

    .login-modal {
        background-color: $color_white;
        width: 30rem;
        height: 350px;
        box-shadow: 2px 2px 5px 1px;
        // overflow-x: auto;
        display: flex;
        flex-direction: column;
        border-radius: 10px;

        .modal-container {
            display: inline-block;
            position: relative;
            .modal-title {
                margin-top: 15px;
                padding-top: 10px;
                width: 100%;
                color: $color_black;
                font-size: $font_size_subtitle;
                font-weight: bolder;
                text-align: center;

                .title {
                    margin: 0;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                }

                .modal-subtitle {
                    color: darken($main_color_1, 10);
                    font-size: 10px;
                }
            }
            .btn-close {
                padding: 0.4rem 0.6rem;
                display: block;
                position: absolute;
                right: 10px;
                top: 5px;
                cursor: pointer;
                font-size: 20px;
                font-weight: bold;
                color: darken($main_color_1, 10);
            }
        }

        form {
            display: flex;
            flex-direction: column;
            margin: 25px auto 0 auto;

            .form-group {
                display: flex;
                flex-direction: column;
                border-radius: 5px;
                background-color: darken($color_grey, 7);
                height: 50px;
                width: 20rem;
                padding: 10px 0 10px 10px;

                input {
                    background-color: darken($color_grey, 7);
                    border: 0;
                }
            }
            .custom-btn {
                margin-top: 25px;
                width: 20rem;
                border-radius: 3px;
            }
        }
    }
}
</style>
