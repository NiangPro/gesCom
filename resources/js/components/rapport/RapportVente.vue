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
                  Rapport des ventes et achats
                </h3>
                
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