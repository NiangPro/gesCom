<template>

    <div>
        <info-vente v-if="info" @listDevis="getInfo" :devis="devisEditing"></info-vente>
        <div class="row" v-if="!info">
           <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card" >
                    <div class="card-header">
                        <h5 class="mb-0">Liste des Devis </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Client</th>
                                        <th>Employé</th>
                                        <th>Montant Total</th>
                                        <th>Produit/Service</th>
                                        <th>Statut</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="vente in devis" :key="vente.id">
                                        <td>{{vente.date}}</td>
                                        <td>{{vente.client.nom}}</td>
                                        <td>{{vente.employed.prenom}} {{vente.employed.nom}}</td>
                                        <td>{{vente.total_amount}} F CFA</td>
                                        <td>
                                            <span v-for="product in devisItems" :key="product.id">
                                                <span v-if="vente.id == product.devis_id">{{product.nom}}</span><br>
                                            </span>
                                        </td>
                                        <td>{{vente.statut}}</td>
                                        <td>
                                            <button class="btn btn-info rounded btn-sm"><i class="fa fa-eye" aria-hidden="true" @click="getDevis(vente.id)"></i></button>
                                            <button class="btn btn-danger rounded btn-sm" ><i class="fa fa-trash" aria-hidden="true" @click="deleteDevis(vente.id)"></i></button> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    props:['devis'],
    data(){
        return {
            info:false,
            devisEditing:null,
            devisItems:null
        }
    },
    methods:{
        refresh(devis){
            this.devis = devis;
            this.showAlert('Le devis a été modifié');
        },
        getDevis(id){
            axios.get('/api/devis/show-'+id)
            .then(response => {this.devisEditing = response.data, this.getInfo()})
            .catch(error => alert(error));
        },
        getInfo(){
            this.info = !this.info;
        },
        getDevisItems(){
            axios.get('/api/devisItems')
            .then(response => this.devisItems = response.data)
            .catch(error => alert(error));
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
        deleteDevis(id){
            axios.delete('/api/devis/'+id)
            .then(response => {this.devis = response.data, this.showAlert('Le devis a été supprimé')})
            .catch(error => alert(error));
        }
    },
    created(){
        this.getDevisItems();
    }
}
</script>
