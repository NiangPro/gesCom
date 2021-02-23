<template>
  <div class="card" id="infoVente">
          <div class="card-header">
              Logo
          </div>
          <div class="card-body">
              <div class="row">
              <div class="col-md-6">
                  Devis pour: <br>
                  <span class="text-bold">{{devis.client.nom}}</span>  <br>
                  <span>{{devis.client.adresse}}</span>
              </div>
              <div class="col-md-6 text-right">
                  Date: 12/08/2002 <br>
                  Bon de commande id : #{{devis.id}}
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
                        <div class="col-md-6 text-left">{{devis.discount}}%</div>
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
                        <div class="col-md-6 text-left text-bold h6 text-success">{{devis.total_amount}} F CFA</div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <button class="btn btn-dark btn-rounded" @click="initDevis">Retour</button>
                <button class="btn btn-success btn-rounded ml-3" >Imprimer</button>
            </div>

        </div>
  </div>
</template>

<script>
export default {
    props:['devis'],
    data(){
        return {
            products:null
        }
    },
    methods:{
        initDevis(){
            this.$emit('listDevis');
        },
        devisItems(){
            axios.get('/api/devisItems/'+this.devis.id)
            .then(response => this.products = response.data)
            .catch(error => alert(error));
        }
    },
    mounted(){
        this.devisItems();
    }

}
</script>

<style>

</style>
