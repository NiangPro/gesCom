<template>
    <div>
        <button type="button" class="btn btn-outline-success toastrDefaultInfo my-3" data-toggle="modal" data-target="#addProduct">
                  Ajouter
        </button>

        <add-product @productAdded="addProduct" @errorAdded="erreur"></add-product>
    <div class="row">
        <info-product :prod="productEditing"></info-product>
        <edit-product @productUpdated="refresh" :form="productEditing"></edit-product>

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card" >
                    <div class="card-header">
                        <h5 class="mb-0">Liste des produits/services </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Type</th>
                                        <th>Tarif</th>
                                        <th>Taxe</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="p in products.data" :key="p.id">
                                            <td>{{p.nom}}</td>
                                            <td>{{p.type}}</td>
                                            <td>{{p.tarif}} F CFA</td>
                                            <td>{{p.taxe}}%</td>
                                        <td> <button type="button" class="btn btn-outline-success btn-sm rounded" data-toggle="modal" title="consulter" data-target="#infoProduct" @click="getProduct(p.id)"><i class="fa fa-eye" aria-hidden="true"></i></button> <button class="btn btn-outline-primary btn-sm rounded mr-2" title="Editer" data-toggle="modal" data-target="#editProduct" @click="getProduct(p.id)"><i class="fa fa-edit" aria-hidden="true"></i></button><button class="btn btn-outline-danger btn-sm rounded" title="Supprimer" @click="deleteProduct(p.id)"><i class="fa fa-trash" aria-hidden="true"></i></button> </td>
                                        </tr>
                                </tbody>
                            </table>
                            <pagination :data="products" @pagination-change-page="getResults" class="mt-3"></pagination>

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
            productEditing:null,
            products:null
        }
    },
    methods:{
        getResults(page=1){
                axios.get('/api/product?page='+page)
                .then(response => this.products = response.data)
                .catch(error => alert(error));
            },
        getProduct(id){
            axios.get('/api/product/show-'+id)
            .then(response => this.productEditing = response.data)
            .catch(error => alert(error));
        },
        deleteProduct(id){
            if(confirm('Êtes-vous sûr de vouloir supprimer ?')){
                axios.delete('/api/product/'+id)
                .then(response => {this.products = response.data, this.showAlert('Le produit a été supprimé')})
                .catch(error => alert(error));
            }else{
                this.showAlert('L\'opération a été annulée');
            }
        },
        refresh(products){
            this.products = products;
            this.showAlert('Les informations du produit ont été supprimées');
        },
        addProduct(products){
                this.products = products;
                this.showAlert('Le produit a été ajouté', 'success');
        },
        erreur(){
            this.showAlert('Tous les champs (*)  sont obligatoires', 'error');
        },
        showAlert(message, type='success') {
        // Use sweetalert2
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                })

                Toast.fire({
                icon: type,
                title: message
                })
            }
    },
    mounted(){
        this.getResults();
    }
}
</script>
