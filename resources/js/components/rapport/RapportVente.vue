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
                <line-chart :chart-data="ventes" :height="165"> </line-chart>               
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          
        </div>
    </div>
        
</template>

<script>
export default {
    data(){
        return {
            ventes:null,
            sumSale:null,
            saleData:null,
            expenseData:null,
        }
    },
    mounted(){
        this.getSaleByMonth();
        this.getExpenseByMonth();
    }, 
    methods:{
        fillData(){
            this.ventes = {
                'labels' : [
                    'Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Decembre'
                    ],
                'datasets' : [
                    {
                        'label' : 'Ventes',
                        'backgroundColor' : 'transparent',
                        'pointBackgroundColor': 'red',
                        'borderColor': 'green',
                        'data' :this.saleData
                    },
                    {
                        'label' : 'Dépenses',
                        'backgroundColor' : 'transparent',
                        'pointBackgroundColor': 'yellow',
                        'borderColor': 'blue',
                        'data' :this.expenseData
                    },
                ] 
            }
        },
        getSaleByMonth(){
            axios.get('/api/saleByMonth')
            .then(response => {this.saleData = response.data, this.fillData()})
            .catch(error => alert(error));
        },
        getExpenseByMonth(){
            axios.get('/api/expenseByMonth')
            .then(response => {this.expenseData = response.data, this.fillData()})
            .catch(error => alert(error));
        }
    }
}
</script>

<style>

</style>