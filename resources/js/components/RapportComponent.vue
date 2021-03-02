<template>
  <div>
    <div class="row mt-5 connectedSortable">
        <section class="col-lg-8">
            <div class="row">
                <section class="col-lg-12 connectedSortable">
                    <rapport-between></rapport-between>
                </section>
                <section class="col-lg-12 connectedSortable">
                    <rapport-vente></rapport-vente>
                </section>
            </div>
        </section>
        <section class="col-lg-4 connectedSortable">
             <div class="row">
                <section class="col-lg-12 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                    <i class="fas fa-coins mr-1"></i>
                    Comptabilité du mois de {{getMonth()}}
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>

                    </div>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img class="d-block w-100" :src="`https://placehold.it/900x800/39CCCC/ffffff&text=VENTE+TOTAL+`+sumSale+`+ FCFA`" alt="First slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" :src="`https://placehold.it/900x800/f39c12/ffffff&text=DEPENSE+TOTAL+`+sumExpense+`+ FCFA`" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" :src="`https://placehold.it/900x800/3c8dbc/ffffff&text=RECETTE+TOTALE+`+balance+`+ FCFA`" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    </div>
                </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
                </section>              
            </div>
        </section>
    </div>
  </div>
</template>

<script>
import { format} from "date-fns";

import { fr } from 'date-fns/locale';
export default {
    data(){
        return {
            sumSale:0,
            sumExpense:0,
            balance:0,
        }
    },
    methods:{
        getMonth() {
            let date = format(new Date(), 'MMMM', { locale: fr });

            return String(date).toUpperCase();
        },
        getSumSale(){
            axios.get('/api/sumSale')
            .then(response => {this.sumSale = response.data, this.balance = this.sumSale-this.sumExpense})
            .catch(error => alert(error));
        },
        getSumExpense(){
            axios.get('/api/sumExpense')
            .then(response => {this.sumExpense = response.data, this.balance = this.sumSale-this.sumExpense})
            .catch(error => alert(error));
        },
        getBalance(){
            this.balance = this.sumSale-this.sumExpense;
        }
    },
    mounted(){
        this.getSumSale();
        this.getSumExpense();
    }
}
</script>

<style>

</style>