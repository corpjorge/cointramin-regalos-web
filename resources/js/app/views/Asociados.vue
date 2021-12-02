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
                        Subir asociados
                    </div>
                    <div class="card-body">
                        <input type="file" id="file" class="form-control" ref="file" @change="handleFileUpload($event)">
                        <button @click="uploadAsociados" class="btn btn-sm btn-primary my-2" style="color: whitesmoke">
                            <i class="fas fa-up text-white-50"></i> Subir
                        </button>
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
                                <th scope="col">Oficina</th>
                                <th scope="col">Tipo</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="asociado in asociados" :key="asociado.id">
                                <th scope="row">{{ asociado.id }}</th>
                                <td>{{ asociado.nombre }}</td>
                                <td>{{ asociado.cedula }}</td>
                                <td>{{ asociado.oficina }}</td>
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
                            <h6><b>Oficina: </b>{{ asociado.oficina }}</h6>
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
            error: false
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
            httpClient.delete('/asociado/'+ id).then(() => {
                this.asociado = null
                this.asociados = null;
                this.show = true
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
