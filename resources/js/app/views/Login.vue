<template>
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"
                             style="background: url('/img/logo.png'); background-size: 86%; background-repeat: no-repeat; background-position: 32px 10px;"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Ingresar</h1>
                                </div>
                                <form @submit.prevent="login" class="user" autocomplete="off">
                                    <div v-if="error" class="alert alert-danger" role="alert">
                                        Error de datos
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user"
                                               id="exampleInputEmail" aria-describedby="emailHelp"
                                               v-model="email"
                                               placeholder="Introduzca la dirección de correo electrónico...">
                                    </div>
                                    <div class="form-group my-2">
                                        <input type="password" class="form-control form-control-user" v-model="password"
                                               id="exampleInputPassword" placeholder="Contraseña">
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-primary" type="submit">Ingresar</button>
                                    </div>
                                    <hr>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import httpClient from "../plugins/AxiosGlobal";

export default {
    name: 'Login',
    data(){
        return {
            email: null,
            password: null,
            error: null
        }
    },
    methods: {
        login() {
            httpClient.post('/login', { email: this.email, password: this.password}).then(response => {
                if(response.data.status) {
                    sessionStorage.setItem('token', response.data.token)
                    this.$router.push({name: 'Inicio'})
                } else {
                    this.error = true;
                }





            })
        }
    }

}
</script>
