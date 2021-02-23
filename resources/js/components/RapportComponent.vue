<template>
  <div>
    <div class="row mt-5 connectedSortable">
        <section class="col-lg-9">
      <rapport-vente></rapport-vente>
        </section>
        <section class="col-lg-3 connectedSortable">
             <div class="row">
                 <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-coins mr-1"></i>
                  Comptabilité Mensuelle
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <section class="col-lg-12 col-12 connectedSortable">
                    <!-- small box -->
                    <div class="small-box bg-success">
                    <div class="inner">
                        <p>Montant Vente</p>
                        <h5>{{sumSale}} F CFA</h5>

                    </div>
                    <div class="icon">
                        <i class="ion ion-bag" style="color:black"></i>
                    </div>
                    <router-link to="/vente" class="small-box-footer">Plus d'info <i class="fas fa-arrow-circle-right"></i></router-link>
                    </div>
                    </section>
                    <section class="col-lg-12 col-12 connectedSortable ">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                        <div class="inner">
                            <p>Montant Dépense</p>
                            <h5>{{sumExpense}} F CFA</h5>

                        </div>
                        <div class="icon">
                            <i class="fa fa-money-bill"  style="color:black"></i>
                        </div>
                        <router-link to="/expense" class="small-box-footer">Plus d'info <i class="fas fa-arrow-circle-right"></i></router-link>
                        </div>
                    </section>
                    <section class="col-lg-12 col-12 connectedSortable">
                        <!-- small box -->
                        <div class="small-box bg-success">
                        <div class="inner">
                            <p>Chiffre d'affaire</p>
                            <h5>{{balance}} F CFA</h5>

                        </div>
                        <div class="icon">
                            <i class="fas fa-balance-scale-right" style="color:black"></i>
                        </div>
                        <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
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

export default {
    data(){
        return {
            sumSale:0,
            sumExpense:0,
            balance:0,
        }
    },
    methods:{
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