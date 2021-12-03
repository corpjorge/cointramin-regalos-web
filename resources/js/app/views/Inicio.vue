<template>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div v-if="show" class="alert alert-success" role="alert">
                            Guardado correctamente
                        </div>
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
                        <h6 class="m-0 font-weight-bold text-primary">Entregar regalo</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h6><b>Nombre: </b>{{ asociado.nombre }}</h6>
                            <h6><b>Fecha de entrega: </b>{{ asociado.fecha_entrega }}</h6>
                            <h6><b>Oficina entrega: </b>{{ asociado.oficina }}</h6>
                            <label for="exampleFormControlTextarea1" class="form-label"><b>Observación:</b></label>
                            <textarea v-if="!asociado.fecha_entrega" class="form-control"
                                      id="exampleFormControlTextarea1" rows="3"
                                      v-model="observaciones"></textarea>
                            <p v-else> {{ asociado.observaciones }}</p>
                            <button v-if="!asociado.fecha_entrega" class="btn btn-primary my-2"
                                    @click="entregar(asociado.id)">Entregar
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
    name: 'Inicio',
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
            httpClient.post('/buscar', {cedula: this.cedula}).then(response => {
                this.asociado = null;
                this.asociados = response.data;
            })
        },
        verAsociado(id) {
            httpClient.get('/asociado/' + id).then(response => this.asociado = response.data)
        },
        entregar(id) {
            httpClient.post('/entregar/' + id, {observaciones: this.observaciones}).then(() => {
                this.asociado = null;
                this.show = true;
                this.observaciones = null;
                setTimeout(() => {
                    this.show = false;
                }, 6000);
            });
        }
    }
}
</script>
