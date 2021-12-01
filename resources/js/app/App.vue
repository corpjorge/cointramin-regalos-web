<template>

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Inicio </h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="color: whitesmoke">
                <i class="fas fa-download fa-sm text-white-50"></i> Generar reporte </a>
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
                        <h6 class="m-0 font-weight-bold text-primary">Entregar regalo</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h6>{{ asociado.nombre }}</h6>
                            <label for="exampleFormControlTextarea1" class="form-label">Observación:</label>
                            <textarea v-if="!asociado.fecha_entrega" class="form-control" id="exampleFormControlTextarea1" rows="3"
                                      v-model="observaciones"></textarea>
                            <p v-else> {{asociado.observaciones}}</p>
                            <button v-if="!asociado.fecha_entrega" class="btn btn-primary my-2" @click="entregar(asociado.id)">Entregar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="show" class="alert alert-success" role="alert">
            Guardado correctamente
        </div>


    </div>


</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            asociados: null,
            asociado: null,
            cedula: null,
            observacion: null,
            show: false
        }
    },
    methods: {
        buscarAsociado() {
            axios.post('/buscar', {cedula: this.cedula}).then(response => {
                this.asociado = null;
                this.asociados = response.data;
            })
        },
        verAsociado(id) {
            axios.get('/asociado/' + id).then(response => this.asociado = response.data)
        },
        entregar(id) {
            axios.post('/entregar/' + id, {observaciones: this.observaciones}).then(() => {
                this.asociado = null;
                this.show = true;
                setTimeout(() => {
                    this.show = false;
                }, 6000);
            });
        }
    }
}
</script>
