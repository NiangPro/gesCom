<template>
    <div>
        <add-client @clientAdded="addClient" @errorAdded="erreur"></add-client>

        <button type="button" class="btn btn-outline-success toastrDefaultInfo my-3" data-toggle="modal" data-target="#addClient">
                  Ajouter
        </button>

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
                                       <th>Pays</th>
                                        <th>Adresse</th>
                                        <th>Email</th>
                                        <th>Tel</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="cli in clients.data" :key="cli.id">
                                            <td>{{cli.nom}}</td>
                                            <td>{{cli.pays}}</td>
                                            <td>{{cli.adresse}}</td>
                                            <td>{{cli.email}}</td>
                                            <td>{{cli.tel}}</td>
                                        <td> <button type="button" class="btn btn-outline-success btn-sm rounded" data-toggle="modal" title="Consulter" data-target="#infoClient" @click="getClient(cli.id)"><i class="fa fa-eye" aria-hidden="true"></i></button> <button class="btn btn-outline-primary btn-sm rounded mr-2" data-toggle="modal" title="Editer" data-target="#editClient" @click="getClient(cli.id)"><i class="fa fa-edit" aria-hidden="true"></i></button><button class="btn btn-outline-danger btn-sm rounded" v-if="user.role === 'Admin'" @click="deleteClient(cli.id)" title="Supprimer"><i class="fa fa-trash" aria-hidden="true"></i></button> </td>
                                        </tr>
                                </tbody>
                            </table>
                            <pagination :data="clients" @pagination-change-page="getResults" class="mt-3"></pagination>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            cliEditing:{},
            user:{},
            clients:null
        }
    },
    methods:{
        getClient(id){
            axios.get('/api/client/show-'+id)
            .then(response => this.cliEditing = response.data)
            .catch(error => alert(error));
        },
        getUser(){
            axios.get('/api/userConnected')
            .then(response => this.user = response.data)
            .catch(error => alert(error));
        },
        refresh(clients){
            this.clients = clients;
            this.showAlert('Les informations du client ont été mises à jour');
        },
        deleteClient(id){
            if(confirm('Êtes-vous sûr de vouloir supprimer ?')){
                axios.delete('/api/client/'+id)
                    .then(response => {this.clients = response.data, this.showAlert('Le client a été supprimé')})
                    .catch(error => alert(error));
            }else{
                this.showAlert('L\'opération a été annulée');
            }
        },
        showAlert(message) {
        // Use sweetalert2
           const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
            })

            Toast.fire({
            icon: 'success',
            title: message
            })
        },
            getResults(page=1){
                 axios.get('/api/client?page='+page)
                .then(response => this.clients = response.data)
                .catch(error => alert(error));
            },
            erreur(){
            this.showAlert('Tous les champs (*) sont obligatoires', 'error');
        },
        addClient(clients){
            this.clients = clients;
            this.showAlert('Le client a été ajouté', 'success');
        }
    },
    mounted(){
        this.getUser();
        this.getResults();
    }
}
</script>
