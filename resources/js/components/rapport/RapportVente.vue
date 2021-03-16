<template>
    <div>

        <div class="row">

          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Rapport des ventes et dépenses
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="widgets.html" data-source-selector="#card-refresh-content" data-load-on-init="false"><i class="fas fa-sync-alt"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>

                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <apexchart type="area" height="350" :options="chartOptions" :series="ventes"></apexchart>

              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>

        </div>
    </div>

</template>

<script>
import VueApexCharts from 'vue-apexcharts'

export default {
    data(){
        return {
            ventes:null,
            sumSale:null,
            saleData:null,
            expenseData:null,
            chartOptions: null,
        }
    },
    methods:{
        fillData(saleData, expenseData){
            this.ventes= [{
            name: 'Ventes',
            data: saleData
          }, {
            name: 'Dépenses',
            data: expenseData
          }],
          this.chartOptions= {
            chart: {
              type: 'area',
              height: 350
            },
            plotOptions: {
              bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
              },
            },
            dataLabels: {
              enabled: false
            },
            stroke: {
              show: true,
              width: 2,
              colors: ['transparent']
            },
            xaxis: {
              categories: ['Jan', 'Feb', 'Mars', 'Avril', 'Mai', 'Jun', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Dec'],
            },
            yaxis: {
              title: {
                text: '(mille) FCFA'
              }
            },
            fill: {
              opacity: 1
            },
            tooltip: {
              y: {
                formatter: function (val) {
                  return val + "F CFA"
                }
              }
            }
          }
        },
        getSaleByMonth(){
            axios.get('/api/saleByMonth')
            .then(response => {this.saleData = response.data, this.fillData(this.saleData, this.expenseData)})
            .catch(error => alert(error));
        },
        getExpenseByMonth(){
            axios.get('/api/expenseByMonth')
            .then(response => {this.expenseData = response.data, this.fillData(this.saleData, this.expenseData)})
            .catch(error => alert(error));
        }
    },
    mounted(){
        this.getSaleByMonth();
        this.getExpenseByMonth();
    },
}
</script>

<style>

</style>
