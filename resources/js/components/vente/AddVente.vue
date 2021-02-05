<template>
    <div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row  mb-3">
                        <div class="col">
                            <h2>Ajout Nouvelle Vente</h2>
                        </div>
                        <div class="col text-right mb-3">
                            <button @click="backToList()" class="btn btn-info">Retour</button>
                        </div>
                    </div>
                    <hr>
                        <!--  Ligne 1 -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Date</span>
                                    </div>
                                    <input type="date" class="form-control"
                                        placeholder="Entrez l'identifiant de l'agence">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Client</span>
                                    </div>
                                    <select class="form-control">
                                        <option>Selectionner un client</option>
                                        <option v-for="cli in clients" :key="cli.id" v-bind:value="cli.nom">{{cli.nom}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Assigné à</span>
                                    </div>
                                    <select  class="form-control">
                                        <option>Selectionner un employé</option>
                                        <option v-for="emp in emps" :key="emp.id" v-bind:value="emp.prenom + ` `+emp.nom">{{emp.prenom}} {{emp.nom}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Commentaire</label>
                                    <textarea class="form-control"></textarea></div>
                            </div>
                        </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row  mb-3">
                        <div class="col">
                            <h2>Bon de commande Article</h2>
                        </div>
                    </div>
                    <hr>
                        <!--  Ligne 1 -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Produits & Services</span>
                                    </div>
                                    <select type="date" class="form-control" v-model="idprod" @change="getProduct">
                                        <option value="">Selectionner un produit ou service </option>
                                        <option v-for="p in products" :key="p.id" v-bind:value="p.id">{{p.nom}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- ligne 2 -->
                        <div class="row mt-3">
                            <table class="table">
                                <thead>
                                    <th>Produit&Service</th>
                                    <th>Description</th>
                                    <th>Tarif</th>
                                    <th>Quantité</th>
                                    <th>TVA</th>
                                    <th>Montant</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <tr v-for="ligne in idRow" :key="ligne.id">
                                        <td><input type="text" class="form-control"></td>
                                        <td><textarea class="form-control"></textarea></td>
                                        <td><input type="number" class="form-control" v-model="prod.nom"></td>
                                        <td><input type="number" class="form-control"></td>
                                        <td><input type="number" class="form-control"></td>
                                        <td><input type="number" class="form-control"></td>
                                        <td><button class="btn btn-danger btn-rounded" ><i class="fa fa-trash" aria-hidden="true" @click="deleteRow"></i></button></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <!-- Montant Total -->
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-info btn-rounded" @click="addRow"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="row text-bold">
                                    <div class="col-md-6">
                                        Montant :
                                    </div>
                                    <div class="col-md-6 text-left">
                                        200 000 F CFA
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!-- Remise -->
                        <div class="row">
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="row text-bold">
                                    <div class="col-md-6">
                                        Remise :
                                    </div>
                                    <div class="col-md-3 text-left">
                                        <div class="input-group">
                                            <input type="number" placeholder="Remise" class="form-control">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-percent" aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!-- Montant final -->
                        <div class="row">
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="row text-bold">
                                    <div class="col-md-6">
                                        Montant Final:
                                    </div>
                                    <div class="col-md-6 text-left">
                                        200 000 F CFA
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Enregistrer la vente -->
                        <div class="row mt-3">
                            <button class="btn btn-success btn-rounded" >Enregister</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            emps:null,
            idRow:1,
            clients:null,
            products:null,
            nbreRows:null,
            commandes:[],
            prod:{
                nom:null
            },
            idprod:null
        }
    },
    methods:{
        backToList(){
            this.$emit('backSale');
        },
        getEmployes(){
            axios.get('/api/employe')
            .then(response => this.emps = response.data)
            .catch(error => alert(error));
        },
        getClients(){
            axios.get('/api/client')
            .then(response => this.clients = response.data)
            .catch(error => alert(error));
        },
        getProducts(){
            axios.get('/api/product')
            .then(response => this.products = response.data)
            .catch(error => alert(error));
        },
        getProduct(){
            if(this.idprod){
                axios.get('/api/product/show-'+this.idprod)
                .then(response => this.prod = response.data)
                .catch(error => alert(error));
            }
        },
        addRow(){
            this.idRow++;
        },
        deleteRow(){
            this.idRow--;
        }
    },
    mounted(){
        this.getEmployes();
        this.getClients();
        this.getProducts();
        this.idRow = 1;
        this.initTable();
    },
    created(){

    }
}
</script>
