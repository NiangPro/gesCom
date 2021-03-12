<template>
    <div class="row">
            <info-fournisseur :fr="frEditing"></info-fournisseur>
            <edit-fournisseur v-on:frUpdated="refresh" :fr="frEditing" ></edit-fournisseur>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card" id="tabcli">
                    <div class="card-header">
                        <h5 class="mb-0">Liste des fournisseurs </h5>
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
                                    <tr v-for="fr in frs" :key="fr.id">
                                            <td>{{fr.nom}}</td>
                                            <td>{{fr.pays}}</td>
                                            <td>{{fr.adresse}}</td>
                                            <td>{{fr.email}}</td>
                                            <td>{{fr.tel}}</td>
                                        <td> <button type="button" class="btn btn-outline-success btn-sm rounded" data-toggle="modal" data-target="#infoFr" @click="getFr(fr.id)"><i class="fa fa-eye" aria-hidden="true"></i></button> <button class="btn btn-outline-primary btn-sm rounded mr-2" data-toggle="modal" data-target="#editFr" @click="getFr(fr.id)"><i class="fa fa-edit" aria-hidden="true"></i></button><button v-if="user.role === 'Admin'" class="btn btn-outline-danger btn-sm rounded" @click="deleteFr(fr.id)"><i class="fa fa-trash" aria-hidden="true"></i></button> </td>
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
    props:['frs'],
    data(){
        return {
            frEditing:{},
            user:{}
        }
    },
    methods:{
        getFr(id){
            axios.get('/api/fournisseur/show-'+id)
            .then(response => this.frEditing = response.data)
            .catch(error => alert(error));
        },
        getUser(){
            axios.get('/api/userConnected')
            .then(response => this.user = response.data)
            .catch(error => alert(error));
        },
        refresh(frs){
            this.frs = frs;
            this.showAlert('Les informations du fournisseur ont été modifiée');
        },
        deleteFr(id){
            if(confirm('Êtes-vous sûr de vouloir supprimer ?')){
                axios.delete('/api/fournisseur/'+id)
                .then(response => {this.frs = response.data, this.showAlert('Le fournisseur a été supprimé')})
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
            }
    },
    mounted(){
        this.getUser();
    }
}
</script>
