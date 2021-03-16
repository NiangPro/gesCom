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
                <apexchart type="bar" height="350" :options="chartOptions" :series="ventes"></apexchart>

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
        fillData(){
            this.getSaleByMonth();
            this.getExpenseByMonth();
            this.ventes= [{
            name: 'Ventes',
            data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
          }, {
            name: 'Dépenses',
            data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
          }],
          this.chartOptions= {
            chart: {
              type: 'bar',
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
            .then(response => {this.saleData = response.data})
            .catch(error => alert(error));
        },
        getExpenseByMonth(){
            axios.get('/api/expenseByMonth')
            .then(response => {this.expenseData = response.data})
            .catch(error => alert(error));
        }
    },
    mounted(){
        this.fillData();
    },
}
</script>

<style>

</style>
