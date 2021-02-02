<template>
    <div class="modal fade" id="editProduct">
        <div class="modal-dialog">
          <div class="modal-content ">
            <div class="modal-header">
              <h4 class="modal-title">Edition du Produit ou Service</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <form>
            <div class="modal-body">
                    <div class="form-group ">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" placeholder="Entrer le nom" v-model="form.nom">
                    </div>
                    <div class="form-group">
                        <label for="fonction">Type</label>
                        <select  class="form-control" v-model="form.type">
                            <option v-for="pt in productType" :key="pt.id" v-bind:value="pt.valeur">{{pt.valeur}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Description</label>
                        <textarea name="description"  class="form-control" v-model="form.description"></textarea>
                    </div>
                    <div class="form-group ">
                        <label for="tarif">Tarif</label>
                        <input type="number" class="form-control" placeholder="Entrer le tarif" v-model="form.tarif">
                        </div>

                    <div class="form-group">
                        <label for="fonction">Taxe</label>
                        <select  class="form-control" v-model="form.taxe">
                            <option v-for="t in taxes" :key="t.id" v-bind:value="t.valeur">{{t.valeur}}</option>
                        </select>
                    </div>
                </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fermer</button>
              <button type="button" class="btn btn-outline-info" data-dismiss="modal" @click="editProduct(form.id)">Modifier</button>
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

            taxes:null,
            productType:null
        }
    },
    methods:{
        getTaxe(){
            axios.get('/api/taxe')
                .then(response => this.taxes = response.data)
                .catch(error => alert(error));
        },
        editProduct(id){
            axios.patch('/api/product/edit-'+id,this.form)
            .then(response => this.$emit('productUpdated', response.data))
            .catch(error => alert(error));
        },
        getProductType(){
            axios.get('/api/productType')
            .then(response => this.productType = response.data)
            .catch(error => alert(error));
        }
    },
    mounted(){
        this.getTaxe();
        this.getProductType();
    }
}
</script>

<style>

</style>
