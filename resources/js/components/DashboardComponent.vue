<template>
    <div>
        <add-todo v-on:todoAdded="nbreTodos"></add-todo>
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{sales.length}}</h3>

                <p>Ventes</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag" style="color:black"></i>
              </div>
              <router-link to="/vente" class="small-box-footer">Plus d'info <i class="fas fa-arrow-circle-right"></i></router-link>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{products.length}}</h3>

                <p>Produits & Services</p>
              </div>
              <div class="icon">
                <i class="fab fa-product-hunt" style="color:orange"></i>
              </div>
              <router-link to="/product" class="small-box-footer">Plus d'info <i class="fas fa-arrow-circle-right"></i></router-link>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-black">
              <div class="inner">
                <h3>{{clients.length}}</h3>

                <p>Clients</p>
              </div>
              <div class="icon">
                <i class="fas fa-users" style="color:cyan"></i>
              </div>
              <router-link to="/client" class="small-box-footer">Plus d'info <i class="fas fa-arrow-circle-right"></i></router-link>
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
              <a href="#" class="small-box-footer">Plus d'info <i class="fas fa-arrow-circle-right"></i></a>
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
                  Sales
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                    </li>
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="revenue-chart"
                       style="position: relative; height: 300px;">
                      <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                   </div>
                  <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                  </div>
                </div>
              </div><!-- /.card-body -->
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
      data(){
        return {
          sales:[],
          clients:[],
          products:[],
          todos:[]
        }
      },
      methods:{
          nbreSales(){
              axios.get('/api/vente')
              .then(response => this.sales = response.data)
              .catch(error => alert(error));
          },
          nbreClients(){
              axios.get('/api/client')
              .then(response => this.clients = response.data)
              .catch(error => alert(error));
          },
          nbreProducts(){
              axios.get('/api/product')
              .then(response => this.products = response.data)
              .catch(error => alert(error));
          },
          nbreTodos(){
              axios.get('/api/todo')
              .then(response => this.todos = response.data)
              .catch(error => alert(error));
          }
      },
        mounted() {
            this.nbreSales();
            this.nbreClients();
            this.nbreProducts();
            this.nbreTodos();
        }
    }
</script>
