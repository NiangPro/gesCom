<template>
  <div>
    <entete :subTitle="subTitle" :title="title"></entete>

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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                            <i class="fas fa-coins mr-1"></i>
                            Graphique du mois de {{getMonth()}}
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>

                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <apexchart type="pie" height="350"  :options="chartOptions" :series="series"></apexchart> 
                        </div><!-- /.card-body -->
                        </div>
                </section>
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
                    <div class="row">
                        <section class="col-lg-12 connectedSortable">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3 class="text-bold">{{series[1]}} FCFA</h3>

                                    <p>Ventes</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag" style="color:black"></i>
                                </div>
                            </div>
                        </section>
                        <!-- ./col -->
                        <section class="col-lg-12 connectedSortable">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3 class="text-bold">{{series[2]}} FCFA</h3>

                                    <p>Depense</p>
                                </div>
                                <div class="icon">
                                   <i class="fas fa-shopping-cart" style="color:black"></i>
                                </div>
                            </div>
                        </section>
                        <!-- ./col -->
                        <section class="col-lg-12 connectedSortable">
                            <!-- small box -->
                            <div class="small-box bg-black">
                                <div class="inner">
                                    <h3 class="text-bold">{{series[0]}} FCFA</h3>

                                    <p>Recette</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-coins" style="color:cyan"></i>
                                </div>
                            </div>
                        </section>
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
            title:'Comptabilité Générale',
            subTitle:'Rapports',
            series: [0,0,0],
            chartOptions:{labels:['Revenues', 'Ventes', 'Dépenses'],
            
            tooltip: {
              y: {
                formatter: function (val) {
                  return val + "F CFA"
                }
              }
            }}
        }
    },
    methods:{
        getMonth() {
            let date = format(new Date(), 'MMMM', { locale: fr });

            return String(date).toUpperCase();
        },
        getSeries(){
            axios.get('/api/compta')
            .then(response => {this.series = response.data})
            .catch(error => alert(error));
        }
    },
    mounted(){
        this.getSeries();
    }
}
</script>

<style>

</style>
