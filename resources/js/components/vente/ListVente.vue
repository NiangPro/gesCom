<template>

    <div>
        <info-vente v-if="info" @listSale="getList" :sale="saleEditing"></info-vente>
        <div class="row" v-if="!info">
           <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card" >
                    <div class="card-header">
                        <h5 class="mb-0">Liste des Ventes </h5>
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="vente in ventes" :key="vente.id">
                                        <td>{{formattedDate(vente.date)}}</td>
                                        <td>{{vente.client.nom}}</td>
                                        <td>{{vente.employed.prenom}} {{vente.employed.nom}}</td>
                                        <td>{{vente.total_amount}} F CFA</td>
                                        <td>
                                            <span v-for="product in produitVendus" :key="product.id">
                                                <span v-if="vente.id == product.vente_id">{{product.nom}}</span><br>
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-outline-success rounded btn-sm" @click="getVente(vente.id)"><i class="fa fa-eye" aria-hidden="true" title="Consulter"></i></button>
                                            <button v-if="user.role === 'Admin'" class="btn btn-outline-primary rounded btn-sm"  @click="getVente(vente.id)" title="Annuler"><i class="fa fa-sync-alt" aria-hidden="true"></i></button>
                                            <button v-if="user.role === 'Admin'" class="btn btn-outline-danger rounded btn-sm"  @click="deleteVente(vente.id)" title="Supprimer"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </td>
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
import { format} from "date-fns";
export default {
    props:['ventes'],
    data(){
        return {
            info:false,
            saleEditing:{},
            produitVendus:[],
            user:{}
        }
    },
    methods:{
        formattedDate(date) {
            return format(new Date(date), 'dd/MM/yyyy')
        },
        getUser(){
            axios.get('/api/userConnected')
            .then(response => this.user = response.data)
            .catch(error => alert(error));
        },
        refresh(ventes){
            this.ventes = ventes;
            this.showAlert('La vente a été modifiée');
        },
        cancelVente(id){
            if(confirm('Êtes-vous sûr de vouloir annuler cette vente ?')){
                axios.delete('/api/venteCancel/'+id)
                .then(response => {this.ventes = response.data, this.showAlert('La vente a été annulée')})
                .catch(error => alert(error));
            }else{
                this.showAlert('L\'opération a été annulée');
            }
        },
        deleteVente(id){
            if(confirm('Êtes-vous sûr de vouloir supprimer ?')){
                axios.delete('/api/vente/'+id)
                .then(response => {this.ventes = response.data, this.showAlert('La vente a été supprimée')})
                .catch(error => alert(error));
            }else{
                this.showAlert('L\'opération a été annulée');
            }
        },
        getVente(id){
            axios.get('/api/vente/show-'+id)
            .then(response => {this.saleEditing = response.data, this.getList()})
            .catch(error => alert(error));
        },
        getList(){
            this.info = !this.info;
        },
        productSallings(){
            axios.get('/api/produitVendus')
            .then(response => this.produitVendus = response.data)
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
        }
    },
    mounted(){
        this.productSallings();
        this.getUser();
    }
}
</script>
