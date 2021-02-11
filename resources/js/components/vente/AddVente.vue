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
                                        <span class="input-group-text" id="basic-addon1">Date <span class="text-danger">*</span></span>
                                    </div>
                                    <input type="date" class="form-control"
                                        placeholder="Entrez l'identifiant de l'agence" v-model="form.date">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Client <span class="text-danger">*</span></span>
                                    </div>
                                    <select class="form-control" v-model="form.client_id">
                                        <option>Selectionner un client</option>
                                        <option v-for="cli in clients" :key="cli.id" v-bind:value="cli.id">{{cli.nom}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Assigné à <span class="text-danger">*</span> </span>
                                    </div>
                                    <select  class="form-control" v-model="form.employed_id">
                                        <option>Selectionner un employé</option>
                                        <option v-for="emp in emps" :key="emp.id" v-bind:value="emp.id">{{emp.prenom}} {{emp.nom}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Commentaire</label>
                                    <textarea class="form-control" v-model="form.description"></textarea></div>
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
                                    <select  class="form-control" v-model="idProd" @change="getProd">
                                        <option v-for="p in products" :key="p.id" v-bind:value="p.id">{{p.nom}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- ligne 2 -->
                        <div class="row mt-3">
                            <table class="table">
                                <thead>
                                    <th>Produit&Service <span class="text-danger">*</span></th>
                                    <th>Description <span class="text-danger">*</span></th>
                                    <th>Tarif <span class="text-danger">*</span></th>
                                    <th>Quantité <span class="text-danger">*</span></th>
                                    <th>TVA</th>
                                    <th>Montant <span class="text-danger">*</span></th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <tr v-for="(prod, k) in form.allProducts" :key="k">
                                        <td><input type="text" class="form-control" v-model="prod.nom"></td>
                                        <td><textarea class="form-control"  v-model="prod.description"></textarea></td>
                                        <td><input type="number" class="form-control" v-model="prod.prix"  @change="getMontant(prod)"></td>
                                        <td><input type="number" class="form-control" v-model="prod.qte"  @change="getMontant(prod)"></td>
                                        <td><input type="number" class="form-control" v-model="prod.taxe"  @change="getMontant(prod)"></td>
                                        <td><input type="number" class="form-control" readonly v-model="prod.amount"></td>
                                        <td><button class="btn btn-danger btn-rounded"><i class="fa fa-trash" aria-hidden="true" @click="deleteRow(k, prod)"></i></button></td>
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
                                        Sous Total :
                                    </div>
                                    <div class="col-md-6 text-left">
                                        {{subTotal}} F CFA
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
                                            <input type="number" placeholder="Remise" v-model="form.discount" @change="getMontantTotal" class="form-control">
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
                                <div class="row ">
                                    <div class="col-md-6 h4">
                                        Montant Final <span class="text-danger">*</span>:
                                    </div>
                                    <div class="col-md-6 text-left text-bold h4 text-success">{{form.total_amount}} F CFA</div>
                                </div>
                            </div>
                        </div>

                        <!-- Enregistrer la vente -->
                        <div class="row mt-3">
                            <button class="btn btn-success btn-rounded" @click="addVente">Enregister</button>
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
            clients:null,
            products:null,

            subTotal:0,
            form:{
                allProducts:[],
                total_amount:0,
                discount:0,
                client_id:null,
                employed_id:null,
                date:null,
                description:null
            },
            idProd:null,
            prodSibling:null,
            idGet:null
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
        addRow(){
            if(this.fieldsNotEmpty() || this.form.allProducts.length == 0){
                this.form.allProducts.push({
                    nom:null,
                    description:null,
                    prix:null,
                    qte:null,
                    taxe:null,
                    amount:null
                });
                this.getMontantTotal();
            }
        },
        deleteRow(index, product){
            let idx = this.form.allProducts.indexOf(product);

            if(idx > -1){
                this.form.allProducts.splice(idx, 1);
            }

            this.getMontantTotal();
        },
        getMontant(product){
            let total = parseFloat(product.prix) * parseFloat(product.qte)* parseFloat(1+product.taxe/100);
            if(!isNaN(total)){
                product.amount = total.toFixed(2);
            }

            this.getMontantTotal();
        },
        getMontantTotal(){
            let subtotal;

            subtotal = this.form.allProducts.reduce(function(sum, product){
                let lineTotal = parseFloat(product.amount);
                if(!isNaN(lineTotal)){
                    return sum + lineTotal;
                }
            },0);

            this.subTotal = subtotal;

            this.form.total_amount = subtotal - (subtotal * (this.form.discount/100));
            this.form.total_amount = parseFloat(this.form.total_amount);
            if (!isNaN(this.form.total_amount)) {
                this.form.total_amount = this.form.total_amount;
            }else{
                this.form.total_amount = '0.00';
            }
        },
        getProd(){
            axios.get('/api/product/show-'+this.idProd)
                .then(response => {this.prodSibling = response.data,this.addToAllProducts()})
                .catch(error => alert(error));

        },
        addToAllProducts(){
            if(this.prodSibling){
                if(this.form.allProducts.length > 0){
                    let lastProd = this.form.allProducts.pop();
                }

                this.form.allProducts.push({
                    nom:this.prodSibling.nom,
                    description:this.prodSibling.description,
                    prix:this.prodSibling.tarif,
                    qte:1,
                    taxe:0,
                    amount:this.prodSibling.tarif
                });

            }


            this.getMontantTotal();
        },
        fieldsNotEmpty(){
            let response = true;

            if(this.form.allProducts.length > 0){
                this.form.allProducts.forEach((item) => {
                    if(item.nom == null || item.description == null || item.qte == null || item.prix == null)
                        response = false;
                });
            }

            return response;
        },
        saleNotEmpty(){
            let response = true;

            if(this.form.client_id == null || this.form.employed_id == null || this.form.total_amount == 0 || this.form.date == null){
                response = false;
            }

            return response;
        },
        addVente(){

            if(this.saleNotEmpty() && this.fieldsNotEmpty()){
            axios.post('/api/vente', this.form)
                .then(response => this.$emit('saleAdded', response.data))
                .catch(error => console.log(error));
            }else{
                alert('Veuillez remplir tous les champs obligatoires(*)');
            }

        }

    },
    mounted(){
        this.getEmployes();
        this.getClients();
        this.getProducts();
        this.addRow();
    }
}
</script>
