<template>
    <div class="container-fluid">
        <div v-if="show" class="alert alert-success" role="alert">
            Guardado correctamente
        </div>

        <div v-if="error" class="alert alert-danger" role="alert">
            Ha ocurrido un error
        </div>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Buscar administrador
                            <button type="button" class="btn btn-primary btn-sm" @click="buttonFromCreate()"><i
                                class="fas fa-plus"></i></button>
                        </h6>
                    </div>
                    <div class="card-body">
                        <label htmlFor="inputPassword5" class="form-label">Cédula </label>
                        <input type="text" id="inputPassword5"
                               class="form-control" aria-describedby="passwordHelpBlock" autocomplete=off
                               v-model="cedula"
                        />
                        <button class="btn btn-sm btn-success my-2" @click="buscarAsociado">Buscar!</button>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Editar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="user in users" :key="user.id">
                                <th scope="row">{{ user.id }}</th>
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" @click="editUser(user.id)"><i
                                        class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid" v-if="user">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Editar administrador</h6>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="updateAdmin" autocomplete="off">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" v-model="user.email">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name" v-model="user.name">
                            </div>
                            <div class="mb-3">
                                <label for="oficina" class="form-label">Oficina</label>
                                <input type="text" class="form-control" id="oficina" v-model="user.oficina">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="exampleInputPassword1"
                                       v-model="user.password">
                            </div>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" v-if="formCreate" autocomplete="off">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Crear administrador</h6>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="fromCreate" autocomplete="off">
                            <div class="mb-3">
                                <label for="mail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="mail"
                                       aria-describedby="emailHelp" v-model="userNew.email">
                            </div>
                            <div class="mb-3">
                                <label for="nameCreate" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nameCreate"
                                       v-model="userNew.name">
                            </div>

                            <div class="mb-3">
                                <label for="oficinac" class="form-label">Oficina</label>
                                <input type="text" class="form-control" id="oficinac"
                                       v-model="userNew.oficina">
                            </div>

                            <div class="mb-3">
                                <label for="pass" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="pass"
                                       v-model="userNew.password">
                            </div>

                            <button type="submit" class="btn btn-primary">Crear</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
import httpClient from "../plugins/AxiosGlobal";

export default {
    name: "Administradores",
    data() {
        return {
            users: null,
            show: false,
            cedula: null,
            user: null,
            userNew: {},
            formCreate: false,
            error: false
        }
    },
    created() {
        this.getUsers();
    },
    methods: {
        getUsers() {
            httpClient.get('/users').then(response => this.users = response.data)
        },
        editUser(id) {
            this.formCreate = false;
            this.userNew = {};
            httpClient.get('/users/' + id + '/edit').then(response => {
                this.user = response.data;
            })
                .catch(() => {
                    this.error = true;
                    setTimeout(() => {
                        this.error = false;
                    }, 6000);
                });
        },
        buttonFromCreate() {
            this.formCreate = true;
            this.user = null;
        },
        fromCreate() {
            httpClient.post('/users', this.userNew).then(() => {
                this.show = true
                this.user = null;
                this.userNew = {};
                this.formCreate = false;
                this.getUsers();
                setTimeout(() => {
                    this.show = false;
                }, 6000);
            })
                .catch(() => {
                    this.error = true;
                    setTimeout(() => {
                        this.error = false;
                    }, 6000);
                });
        },
        updateAdmin() {
            httpClient.put('/users/' + this.user.id, this.user).then(() => {
                this.show = true
                this.user = null;
                this.userNew = {};
                this.getUsers();
                setTimeout(() => {
                    this.show = false;
                }, 6000);
            })
        }
    }
}
</script>

<style scoped>

</style>
