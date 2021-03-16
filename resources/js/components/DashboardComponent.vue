<template>
    <div>
        <entete :subTitle="subTitle" :title="title"></entete>
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ sales }}</h3>

                        <p>Ventes</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag" style="color:black"></i>
                    </div>
                    <!-- <router-link to="/vente" class="small-box-footer">Plus d'info <i class="fasfa-arrow-circle-right"></i></router-link> -->
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ products }}</h3>

                        <p>Produits & Services</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-product-hunt" style="color:orange"></i>
                    </div>
                    <!-- <router-link to="/product" class="small-box-footer">Plus d'info <i class="fas fa-arrow-circle-right"></i></router-link> -->
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-black">
                    <div class="inner">
                        <h3>{{ clients }}</h3>

                        <p>Clients</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users" style="color:cyan"></i>
                    </div>
                    <!-- <router-link to="/client" class="small-box-footer">Plus d'info <i class="fas fa-arrow-circle-right"></i></router-link> -->
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{devis}}</h3>

                        <p>Devis</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph" style="color:green"></i>
                    </div>
                    <!-- <router-link href="#" class="small-box-footer">Plus d'info <i class="fas fa-arrow-circle-right"></i></router-link> -->
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-5 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-pie mr-1"></i>
                            Statistique des Ventes
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item active">
                                    <a
                                        class="nav-link cursor-pointer"
                                        data-toggle="tab"
                                        >Ventes</a
                                    >
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <apexchart height="375" type="pie" :options="opts" :series="ventes"></apexchart>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-7 connectedSortable">
                 <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-pie mr-1"></i>
                            Statistique des Dépenses
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item active">
                                    <a
                                        class="nav-link cursor-pointer"
                                        data-toggle="tab"
                                        >Dépenses</a
                                    >
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <apexchart height="360" type="area" :options="options" :series="expenses"></apexchart>
                    </div>
                    <!-- /.card-body -->
                </div>

            </section>
            <!-- right col -->
        </div>

        <div class="row">
            <!-- Left col -->
            <section class="col-lg-6 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <last-history></last-history>
                <!-- /.card -->
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-6 connectedSortable">
                 <!-- TO DO List -->
                <list-todo></list-todo>
                <!-- /.card -->
            </section>
            <!-- right col -->
        </div>
    </div>
</template>

<script>
import VueApexCharts from 'vue-apexcharts'
export default {
    data() {
        return {
            title:'Accueil',
            opts:{labels: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
            theme: {
              palette: 'palette2'
            },
            tooltip: {
              y: {
                formatter: function (val) {
                  return val + "F CFA"
                }
              }
            }},
            subTitle:'',
            sales: null,
            clients: null,
            products: null,
            devis:null,
            ventes: [],
            saleData: [],
            etat: false,
            expenses: [],
            expenseData: [],

        options: {
        chart: {
          id: 'vuechart-example'
        },
        xaxis: {
          categories: [
                    "Janvier",
                    "Fevrier",
                    "Mars",
                    "Avril",
                    "Mai",
                    "Juin",
                    "Juillet",
                    "Août",
                    "Septembre",
                    "Octobre",
                    "Novembre",
                    "Decembre"
                ]
        },
            tooltip: {
              y: {
                formatter: function (val) {
                  return val + "F CFA"
                }
              }
            }
      }
        };
    },
    methods: {
        nbreDevis() {
            axios
                .get("/api/nbreDevis")
                .then(response => this.devis = response.data)
                .catch(error => alert(error));
        },
        nbreSales() {
            axios
                .get("/api/nbreVentes")
                .then(response => (this.sales = response.data))
                .catch(error => alert(error));
        },
        nbreClients() {
            axios
                .get("/api/nbreClients")
                .then(response => (this.clients = response.data))
                .catch(error => alert(error));
        },
        nbreProducts() {
            axios
                .get("/api/nbreProducts")
                .then(response => (this.products = response.data))
                .catch(error => alert(error));
        },
        fillSale() {
            // this.ventes = [{
            //         name: 'Ventes',
            //         data: this.saleData
            //     }]
            this.ventes = this.saleData;
        },
        fillExpense() {
            this.expenses =  [{
                    name: 'Dépenses',
                    data: this.expenseData
                }]
        },
        getSaleByMonth() {
            axios
                .get("/api/saleByMonth")
                .then(response => {
                    (this.saleData = response.data), this.fillSale()
                })
                .catch(error => alert(error));
        },
        getExpenseByMonth() {
            axios
                .get("/api/expenseByMonth")
                .then(response => {
                    (this.expenseData = response.data), this.fillExpense()
                })
                .catch(error => alert(error));
        }
    },
    mounted() {
        this.getSaleByMonth();
        this.getExpenseByMonth();
        this.nbreSales();
        this.nbreClients();
        this.nbreProducts();
        this.nbreDevis();
    }
};
</script>
