<template>
  <div>
        <div class="card" id="infoVente">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <img :src="`storage/images/`+donnees.logo" class="figure-img img-fluid rounded" alt="" style="max-height:90px;"> {{donnees.name}}
                    </div>
                    <div class="col-md-6 text-right">
                        Date: <span class="text-bold h4">{{formattedDate(sale.date)}}</span> <br>
                        Numéro Facture : #{{sale.id}}
                    </div>
                </div>

          </div>
          <div class="card-body">
              <div class="row">
                <div class="col">
                    <span class="text-bold h4"><u>FACTURE POUR</u></span>:
                    <span class="text-bold h3">{{sale.client.nom}}</span>  <br>
                    <u>ADRESSE</u>:  <span class="h5">{{sale.client.adresse}}</span>
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
            <div class="row" v-if="sale.discount > 0">
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
                        <div class="col-md-6 h3">
                            <u>Montant Final</u>:
                        </div>
                        <div class="col-md-6 text-left text-bold h2 text-success">{{sale.total_amount}} F CFA</div>
                    </div>
                </div>
            </div>
            <div class="container">
                <p class="text-center text-body">MERCI POUR VOTRE CONFIANCE, A BIENTÔT !!!</p>
            </div>
        </div>
        </div>
        <div class="row m-3">
                <button class="btn btn-outline-dark btn-rounded" @click="initSale">Retour</button>
                <button class="btn btn-outline-success btn-rounded ml-3" @click="printDiv('infoVente')">Imprimer</button>
        </div>
  </div>
</template>

<script>
import { format} from "date-fns";
export default {
    props:['sale'],
    data(){
        return {
            products:null,
            donnees:null
        }
    },
    methods:{
        formattedDate(date) {
            return format(new Date(date), 'MM/dd/yyyy')
        },
        initSale(){
            this.$emit('listSale');
        },
        produitVendus(){
            axios.get('/api/productSalling/'+this.sale.id)
            .then(response => this.products = response.data)
            .catch(error => alert(error));

        },
         printDiv(divID) {
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML =
              "<html><head><title></title></head><body>" +
              divElements + "</body>";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;

            document.location.reload();


        },
        getVars(){
            axios.get('/api/appvars')
            .then(response => {this.donnees = response.data})
            .catch(error => alert(error));
        }
    },
    mounted(){
        this.produitVendus();
        this.getVars();
    }

}
</script>

<style>

</style>
