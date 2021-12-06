<template>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Inicio </h1>
        </div>

        <div v-if="show" class="alert alert-success" role="alert">
            Guardado correctamente
        </div>

        <div v-if="error" class="alert alert-danger" role="alert">
            Ha ocurrido un error
        </div>

        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        Crear asociado
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="crearAsociado" autocomplete="off">
                            <div class="mb-3">
                                <label for="mail" class="form-label">Cedula</label>
                                <input type="number" class="form-control" id="mail"
                                       aria-describedby="emailHelp" v-model="asociadoNuevo.cedula">
                            </div>

                            <div class="mb-3">
                                <label for="nameCreate" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nameCreate"
                                       v-model="asociadoNuevo.nombre">
                            </div>

                            <div class="mb-3">
                                <label for="tipo" class="form-label">Tipo de regalo</label>
                                <input type="text" class="form-control" id="tipo"
                                       v-model="asociadoNuevo.tipo">
                            </div>

                            <button type="submit" class="btn btn-primary">Crear</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        Subir asociados
                    </div>
                    <div class="card-body">
                        <input type="file" id="file" class="form-control" ref="file" @change="handleFileUpload($event)">
                        <button @click="uploadAsociados" class="btn btn-sm btn-primary my-2" style="color: whitesmoke">
                            <i class="fas fa-up text-white-50"></i> Subir
                        </button>
                    </div>
                    <hr>
                    <a href="/ejemplo.xlsx" class="m-2">Clic aqui para descargar ejemplo de archivo de cargue</a>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        Descargar o eliminar
                    </div>
                    <div class="card-body">
                        <a href="/asociados/export" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                           style="color: whitesmoke">
                            <i class="fas fa-download fa-sm text-white-50"></i> Generar reporte
                        </a>
                        <hr>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Vaciar base de datos
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Vaciar base de datos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Esta seguro que desea vaciar la base de datos?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" @click="deleteBD">Vaciar BD</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Buscar asociados</h6>
                    </div>
                    <div class="card-body">
                        <label htmlFor="inputPassword5" class="form-label">Cédula </label>
                        <input type="text" id="inputPassword5"
                               class="form-control" aria-describedby="passwordHelpBlock" autocomplete=off
                               v-model="cedula"
                        />
                        <button class="btn btn-sm btn-success my-2" @click="buscarAsociado">Buscar!</button>

                        <table v-if="asociados" class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Cedula</th>
                                <th scope="col">Tipo</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="asociado in asociados" :key="asociado.id">
                                <th scope="row">{{ asociado.id }}</th>
                                <td>{{ asociado.nombre }}</td>
                                <td>{{ asociado.cedula }}</td>
                                <td>{{ asociado.tipo }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info my-2" @click="verAsociado(asociado.id)">ver
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div v-if="asociado" class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Usuario</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h6><b>Nombre: </b>{{ asociado.nombre }}</h6>
                            <h6><b>Cedula: </b>{{ asociado.cedula }}</h6>
                            <button class="btn btn-primary my-2"
                                    @click="eliminar(asociado.id)">Eliminar
                            </button>
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
    name: "Asociados",
    data() {
        return {
            file: null,
            asociados: null,
            asociado: null,
            cedula: null,
            show: false,
            error: false,
            asociadoNuevo: {}
        }
    },
    methods: {
        handleFileUpload() {
            this.file = this.$refs.file.files[0];
        },
        uploadAsociados() {
            let formData = new FormData();
            formData.append('file', this.file);
            httpClient.post('/asociados/import', formData, {headers: {'Content-Type': 'multipart/form-data'}})
                .then(() => {
                    this.show = true
                    setTimeout(() => {
                        this.show = false;
                    }, 6000);
                })
                .catch(() => {
                    this.error = false;
                    setTimeout(() => {
                        this.error = false;
                    }, 6000);
                });

        },
        buscarAsociado() {
            httpClient.post('/buscar', {cedula: this.cedula}).then(response => {
                this.asociado = null;
                this.asociados = response.data;
            })
        },
        verAsociado(id) {
            httpClient.get('/asociado/' + id).then(response => this.asociado = response.data)
        },
        eliminar(id) {
            httpClient.delete('/asociado/' + id).then(() => {
                this.asociado = null
                this.asociados = null;
                this.show = true
                setTimeout(() => {
                    this.show = false;
                }, 6000);
            })
        },
        crearAsociado() {
            httpClient.post('/asociado', this.asociadoNuevo).then(() => {
                this.asociadoNuevo = {}
                this.show = true
                setTimeout(() => {
                    this.show = false;
                }, 6000);
            })
        },
        deleteBD() {
            httpClient.delete('bd/delete').then(() => {
                this.show = true
                setTimeout(() => {
                    this.show = false;
                }, 6000);
            }).catch(() => {
                this.error = true;
                setTimeout(() => {
                    this.error = false;
                }, 6000);
            })
        }
    }
}
</script>

<style scoped>

</style>
