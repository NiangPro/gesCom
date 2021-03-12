<template>
    <div class="modal fade" id="addProduct">
        <div class="modal-dialog">
          <div class="modal-content ">
            <div class="modal-header">
              <h4 class="modal-title">Ajout Produit ou Service</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <form>
            <div class="modal-body">
                    <div class="form-group ">
                        <label for="nom">Nom<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Entrer le nom" v-model="form.nom">
                    </div>
                    <div class="form-group">
                        <label for="fonction">Type<span class="text-danger">*</span></label>
                        <select  class="form-control" v-model="form.type">
                            <option v-for="pt in productType" :key="pt.id" v-bind:value="pt.valeur">{{pt.valeur}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Description<span class="text-danger">*</span></label>
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
              <button type="button" class="btn btn-outline-info" data-dismiss="modal" @click="addProduct">Ajouter</button>
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
                nom:'',
                type:'',
                description:'',
                taxe:0,
                tarif:0
            },
            taxes:{},
            productType:{}
        }
    },
    methods:{
        getTaxe(){
            axios.get('/api/taxe')
                .then(response => this.taxes = response.data)
                .catch(error => alert(error));
        },
        addProduct(){
            if(this.notEmpty()){
                axios.post('/api/product',this.form)
                .then(response => this.$emit('productAdded', response.data))
                .catch(error => alert(error));
            }else{
                this.$emit('errorAdded');
            }
        },
        getProductType(){
            axios.get('/api/productType')
            .then(response => this.productType = response.data)
            .catch(error => alert(error));
        },
        notEmpty(){
            if(this.form.nom === '' || this.form.type === '' || this.form.description === ''){
                return false;
            }else{
                return true;
            }
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
