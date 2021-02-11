<template>
  <div class="card">
          <div class="card-header">
              Logo
          </div>
          <div class="card-body">
              <div class="row">
              <div class="col-md-6">
                  Devis pour: <br>
                  <span class="text-bold">{{sale.client.nom}}</span>  <br>
                  <span>{{sale.client.adresse}}</span>
              </div>
              <div class="col-md-6 text-right">
                  Date: 12/08/2002 <br>
                  Bon de commande id : #{{sale.id}}
              </div>
          </div>
          <div class="row mt-2">
              <table class="table table-striped">
                  <thead>
                      <th>Produit/Service</th>
                      <th>Description</th>
                      <th>Tarif</th>
                      <th>Quantité</th>
                      <th>TVA</th>
                      <th>Montant</th>
                  </thead>
                  <tbody>
                      <tr v-for="prod in products" :key="prod.id">
                          <td>{{prod.nom}}</td>
                          <td>{{prod.description}}</td>
                          <td>{{prod.amount}}</td>
                          <td>{{prod.qte}}</td>
                          <td>{{prod.taxe}}</td>
                          <td>{{prod.amount * prod.qte}}</td>
                      </tr>
                  </tbody>
              </table>
          </div>
        </div>
        <div class="card-footer card-white">
            <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6 text-right">
                    <div class="row ">
                        <div class="col-md-6 h6">
                            Remise:
                        </div>
                        <div class="col-md-6 text-left">{{sale.discount}}%</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6 text-right">
                    <div class="row ">
                        <div class="col-md-6 h6">
                            Montant Final:
                        </div>
                        <div class="col-md-6 text-left text-bold h6 text-success">{{sale.total_amount}} F CFA</div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <button class="btn btn-dark btn-rounded" @click="initSale">Retour</button>
            </div>

        </div>
  </div>
</template>

<script>
export default {
    props:['sale'],
    data(){
        return {
            products:null
        }
    },
    methods:{
        initSale(){
            this.$emit('listSale');
        },
        produitVendus(){
            axios.get('/api/productSalling/'+this.sale.id)
            .then(response => this.products = response.data)
            .catch(error => alert(error));

        }
    },
    mounted(){
        this.produitVendus();
    }

}
</script>

<style>

</style>
