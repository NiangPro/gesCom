<template>
    <div class="modal fade" id="editExpense">
        <div class="modal-dialog">
          <div class="modal-content ">
            <div class="modal-header">
              <h4 class="modal-title">Edition Dépense</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <form enctype="multipart/form-data">
            <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label >Catégorie</label>
                        <select  class="form-control" v-model="form.category">
                            <option v-for="cat in categories" :key="cat.id" v-bind:value="cat.valeur">{{cat.valeur}}</option>
                        </select>
                        </div>
                        <div class="form-group col-md-6">
                        <label >Montant</label>
                        <input type="number" class="form-control" placeholder="Entrer le montant" v-model="form.montant">
                        </div>
                    </div>

                    <div class="form-group">
                        <label >Mode de paiement</label>
                        <select  class="form-control" v-model="form.payment_mode">
                            <option v-for="pm in payments_mode" :key="pm.id" v-bind:value="pm.valeur">{{pm.valeur}}</option>
                        </select>
                        </div>

                    <div class="form-group">
                        <label for="adresse">Date</label>
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
              <button type="button" class="btn btn-outline-info" data-dismiss="modal" @click="editExpense(form.id)">Modifier</button>
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
    props:['form'],
    data(){
        return {

            categories:null,
            payments_mode: null
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
        editExpense(id){
            axios.patch('/api/expense/edit-'+id, this.form)
                .then(response => this.$emit('expenseUpdated', response.data))
                .catch(error => alert(error));
        }
    },
    mounted(){
        this.getCategories();
        this.getPaymentMode();
    }
}
</script>
