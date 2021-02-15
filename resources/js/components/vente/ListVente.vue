<template>

    <div>
        <info-vente v-if="info" @listSale="getInfo" :sale="saleEditing"></info-vente>
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
                                        <td>{{vente.date}}</td>
                                        <td>{{vente.client.nom}}</td>
                                        <td>{{vente.employed.prenom}} {{vente.employed.nom}}</td>
                                        <td>{{vente.total_amount}} F CFA</td>
                                        <td>
                                            <span v-for="product in produitVendus" :key="product.id">
                                                <span v-if="vente.id == product.vente_id">{{product.nom}}</span><br>
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-info rounded btn-sm"><i class="fa fa-eye" aria-hidden="true" @click="getVente(vente.id)"></i></button>
                                            <button class="btn btn-danger rounded btn-sm" @click="deleteVente(vente.id)"><i class="fa fa-trash" aria-hidden="true"></i></button> </td>
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
    props:['ventes'],
    data(){
        return {
            info:false,
            saleEditing:null,
            produitVendus:null
        }
    },
    methods:{
        refresh(ventes){
            this.ventes = ventes;
        },
        getVente(id){
            axios.get('/api/vente/show-'+id)
            .then(response => {this.saleEditing = response.data, this.getInfo()})
            .catch(error => alert(error));
        },
        getInfo(){
            this.info = !this.info;
        },
        productSallings(){
            axios.get('/api/produitVendus')
            .then(response => this.produitVendus = response.data)
            .catch(error => alert(error));
        }
    },
    mounted(){
        this.productSallings();
    }
}
</script>
