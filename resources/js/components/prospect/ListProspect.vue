<template>
 <div>
     <add-prospect @prospectAdded="addProspect" @errorAdded="erreur"></add-prospect>

        <button type="button" class="btn btn-outline-success toastrDefaultInfo my-3" data-toggle="modal" data-target="#addProspect">
                  Ajouter
        </button>
    <div class="row">
            <edit-prospect v-on:prospectUpdated="refresh" :form="prospectEditing" ></edit-prospect>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card" id="tabcli">
                    <div class="card-header">
                        <h5 class="mb-0">Liste des prospects </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sujet</th>
                                        <th>Source</th>
                                        <th>Assigné à</th>
                                        <th>Pays</th>
                                        <th>Adresse</th>
                                        <th>Email</th>
                                        <th>Tel</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="p in prospects.data" :key="p.id">
                                            <td>{{p.sujet}}</td>
                                            <td>{{p.source}}</td>
                                            <td>{{p.assignation}}</td>
                                            <td>{{p.pays}}</td>
                                            <td>{{p.adresse}}</td>
                                            <td>{{p.email}}</td>
                                            <td>{{p.tel}}</td>
                                        <td> <button class="btn btn-outline-primary btn-sm rounded mr-2" data-toggle="modal" data-target="#editProspect" @click="getProspect(p.id)"><i class="fa fa-edit" aria-hidden="true"></i></button><button class="btn btn-outline-danger btn-sm rounded" v-if="user.role === 'Admin'" @click="deleteProspect(p.id)"><i class="fa fa-trash" aria-hidden="true"></i></button> </td>
                                        </tr>
                                </tbody>
                            </table>
                            <pagination :data="prospects" @pagination-change-page="getResults" class="mt-3"></pagination>

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
            prospectEditing:{},
            user:{},
            prospects:null
        }
    },
    methods:{
        getProspect(id){
            axios.get('/api/prospect/show-'+id)
            .then(response => this.prospectEditing = response.data)
            .catch(error => alert(error));
        },
        refresh(prospects){
            this.prospects = prospects;
            this.showAlert('Les informations du prospect ont été supprimées');
        },
        getUser(){
            axios.get('/api/userConnected')
            .then(response => this.user = response.data)
            .catch(error => alert(error));
        },
        deleteProspect(id){
            if(confirm('Êtes-vous sûr de vouloir supprimer ?')){
                axios.delete('/api/prospect/'+id)
                .then(response => {this.prospects = response.data, this.showAlert('Le prospect a été supprimé')})
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
            axios.get('/api/prospect?page='+page)
            .then(response => this.prospects = response.data)
            .catch(error => alert(error));
        },
        erreur(){
            this.showAlert('Tous les champs (*) sont obligatoires', 'error');
        },
        addProspect(prospects){
            this.prospects = prospects;
            this.showAlert('Le prospect a été ajouté', 'success');
        }
    },
    mounted(){
        this.getUser();
        this.getResults();
    }
}
</script>
