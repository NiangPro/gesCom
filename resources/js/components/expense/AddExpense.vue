<template>
    <div class="modal fade" id="addExpense">
        <div class="modal-dialog">
          <div class="modal-content ">
            <div class="modal-header">
              <h4 class="modal-title">Ajout Dépense</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <form enctype="multipart/form-data">
            <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>Catégorie<span class="text-danger">*</span></label>
                        <select  class="form-control" v-model="form.category">
                            <option v-for="cat in categories" :key="cat.id" v-bind:value="cat.valeur">{{cat.valeur}}</option>
                        </select>
                        </div>
                        <div class="form-group col-md-6">
                        <label >Montant<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" placeholder="Entrer le montant" v-model="form.montant">
                        </div>
                    </div>

                    <div class="form-group">
                        <label >Mode de paiement<span class="text-danger">*</span></label>
                        <select  class="form-control" v-model="form.payment_mode">
                            <option v-for="pm in payments_mode" :key="pm.id" v-bind:value="pm.valeur">{{pm.valeur}}</option>
                        </select>
                        </div>

                    <div class="form-group">
                        <label for="adresse">Date<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" placeholder="Entrer la date" v-model="form.date">
                    </div>

                    <div class="form-group">
                        <label for="adresse">Description</label>
                        <textarea name="description"  class="form-control" v-model="form.description"></textarea>
                    </div>

                   <div class="form-group">
                        <label for="fonction">Reférence</label>
                        <input type="text" class="form-control" placeholder="Entrer le reférence" v-model="form.recu">
                    </div>
                </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fermer</button>
              <button type="button" class="btn btn-outline-success" data-dismiss="modal" @click="addExpense()">Ajouter</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
</template>

<script>
export default {
    data(){
        return {
            form:{
                category:'',
                payment_mode:'',
                description:'',
                date:'',
                montant:'',
                recu:''
            },
            categories:{},
            payments_mode: {}
        }
    },
    methods:{
        getCategories(){
            axios.get('/api/expenseType')
            .then(response => this.categories = response.data)
            .catch(error => alert(error));
        },
        getPaymentMode(){
            axios.get('/api/paymentsMode')
            .then(response => this.payments_mode = response.data)
            .catch(error => alert(error));
        },
        addExpense(){
            if(this.notEmpty()){
                axios.post('/api/expense', this.form)
                .then(response => {this.$emit('expenseAdded', response.data), this.initForm()})
                .catch(error => alert(error));
            }else{
                this.$emit('errorAdded');
            }
        },
        initForm(){
            this.form.category = '';
                this.form.payment_mode = '';
                this.form.description = '';
                this.form.date = '';
                this.form.montant = '';
                this.form.recu = '';
        },
        notEmpty(){
            if(this.form.category === '' || this.form.payment_mode === '' || this.form.date === '' || this.form.montant === ''){
                return false;
            }else{
                return true;
            }
        }
    },
    mounted(){
        this.getCategories();
        this.getPaymentMode();
    }
}
</script>
