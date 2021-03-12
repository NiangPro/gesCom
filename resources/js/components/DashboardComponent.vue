<template>
    <div>
        <add-todo v-on:todoAdded="nbreTodos"></add-todo>
       <entete :subTitle="subTitle" :title="title"></entete>
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ sales.length }}</h3>

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
                        <h3>{{ products.length }}</h3>

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
                        <h3>{{ clients.length }}</h3>

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
                        <h3>65</h3>

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
            <section class="col-lg-7 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-pie mr-1"></i>
                            Statistique des Ventes et des Achats
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item active">
                                    <a
                                        class="nav-link cursor-pointer"
                                        @click="changeEtat"
                                        data-toggle="tab"
                                        >Ventes</a
                                    >
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        @click="changeEtat"
                                        data-toggle="tab"
                                        >Dépenses</a
                                    >
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <line-chart
                            :chart-data="ventes"
                            :height="165"
                            v-if="!etat"
                        >
                        </line-chart>
                        <line-chart
                            :chart-data="expenses"
                            :height="165"
                            v-if="etat"
                        >
                        </line-chart>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">
                <!-- TO DO List -->
                <list-todo :todos="todos"></list-todo>
                <!-- /.card -->
            </section>
            <!-- right col -->
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            title:'Accueil',
            subTitle:'',
            sales: [],
            clients: [],
            products: [],
            devis: [],
            todos: [],
            ventes: [],
            saleData: [],
            etat: false,
            expenses: [],
            expenseData: [],
            months:[
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
        };
    },
    methods: {
        nbreDevis() {
            axios
                .get("/api/nbreDevis")
                .then(response => console.log(response.data))
                .catch(error => alert(error));
        },
        nbreSales() {
            axios
                .get("/api/vente")
                .then(response => (this.sales = response.data))
                .catch(error => alert(error));
        },
        nbreClients() {
            axios
                .get("/api/client")
                .then(response => (this.clients = response.data))
                .catch(error => alert(error));
        },
        nbreProducts() {
            axios
                .get("/api/product")
                .then(response => (this.products = response.data))
                .catch(error => alert(error));
        },
        nbreTodos() {
            axios
                .get("/api/todo")
                .then(response => (this.todos = response.data))
                .catch(error => alert(error));
        },
        fillSale() {
            this.ventes = {
                labels: this.months,
                datasets: [
                    {
                        label: "Ventes",
                        backgroundColor: "green",
                        pointBackgroundColor: "red",
                        data: this.saleData
                    }
                ]
            };
        },
        fillExpense() {
            this.expenses = {
                labels: this.months,
                datasets: [
                    {
                        label: "Dépenses",
                        backgroundColor: "orange",
                        pointBackgroundColor: "red",
                        data: this.expenseData
                    }
                ]
            };
        },
        getSaleByMonth() {
            axios
                .get("/api/saleByMonth")
                .then(response => {
                    (this.saleData = response.data), this.fillSale();
                })
                .catch(error => alert(error));
        },
        getExpenseByMonth() {
            axios
                .get("/api/expenseByMonth")
                .then(response => {
                    (this.expenseData = response.data), this.fillExpense();
                })
                .catch(error => alert(error));
        },
        changeEtat() {
            this.etat = !this.etat;
            if (this.etat) {
                this.getExpenseByMonth();
            } else {
                this.getSaleByMonth();
            }
        }
    },
    mounted() {
        this.nbreSales();
        this.nbreClients();
        this.nbreProducts();
        this.nbreTodos();
        this.getSaleByMonth();
        this.nbreDevis();
    }
};
</script>
