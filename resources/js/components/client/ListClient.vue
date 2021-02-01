<template>
    <div class="row">
            <info-client :cli="cliEditing"></info-client>
            <edit-client v-on:clientUpdated="refresh" :cli="cliEditing" ></edit-client>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card" id="tabcli">
                    <div class="card-header">
                        <h5 class="mb-0">Liste des clients </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Pays</th>
                                        <th>Adresse</th>
                                        <th>Email</th>
                                        <th>Tel</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="cli in clients" :key="cli.id">
                                            <td>{{cli.prenom}}</td>
                                            <td>{{cli.nom}}</td>
                                            <td>{{cli.pays}}</td>
                                            <td>{{cli.adresse}}</td>
                                            <td>{{cli.email}}</td>
                                            <td>{{cli.tel}}</td>
                                        <td> <button type="button" class="btn btn-info rounded" data-toggle="modal" data-target="#infoClient" @click="getClient(cli.id)"><i class="fa fa-eye" aria-hidden="true"></i></button> <button class="btn btn-warning rounded mr-2" data-toggle="modal" data-target="#editClient" @click="getClient(cli.id)"><i class="fa fa-edit" aria-hidden="true"></i></button><button class="btn btn-danger rounded" @click="deleteClient(cli.id)"><i class="fa fa-trash" aria-hidden="true"></i></button> </td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
export default {
    props:['clients'],
    data(){
        return {
            cliEditing:{}
        }
    },
    methods:{
        getClient(id){
            axios.get('/api/client/show-'+id)
            .then(response => this.cliEditing = response.data)
            .catch(error => alert(error));
        },
        refresh(){
            axios.get('/api/client')
            .then(response => this.clients = response.data)
            .catch(error => alert(error));
        },
        deleteClient(id){
            axios.delete('/api/client/'+id)
            .then(response => this.clients = response.data)
            .catch(error => alert(error));
        }
    }
}
</script>
