<template>
    <div class="modal fade" id="editClient">
        <div class="modal-dialog">
          <div class="modal-content ">
            <div class="modal-header">
              <h4 class="modal-title">Edition Client</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <form>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="nom">Nom<span class="text-danger">*</span></label>
                        <input type="text" class="form-control"  placeholder="Entrer le nom" v-model="cli.nom">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="email">Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" placeholder="Entrer l'adresse email" v-model="cli.email">
                        </div>
                        <div class="form-group col-md-6">
                        <label for="tel">Telephone<span class="text-danger">*</span></label>
                        <input type="text" class="form-control"  placeholder="Entrer le numéro de telephone" v-model="cli.tel">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Entrer l'adresse" v-model="cli.adresse">
                    </div>

                    <div class="form-group">
                        <label for="fonction">Pays<span class="text-danger">*</span></label>
                        <select  class="form-control" v-model="cli.pays">
                            <option v-for="p in pays" :key="p.id" v-bind:value="p.nom_fr">{{p.nom_fr}}</option>
                        </select>
                    </div>
                </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fermer</button>
              <button type="button" class="btn btn-outline-info" @click="editClient()" data-dismiss="modal">Modifier</button>
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
        props:['cli'],
        data(){
            return {
                pays:{}
            }
        },
        methods:{
            editClient(){
                axios.patch('/api/client/edit-'+this.cli.id, this.cli)
                .then(response => this.$emit('clientUpdated', response.data))
                .catch(error => alert(error));
            },
             getCountry(){
                axios.get('/api/pays')
                .then(response => this.pays = response.data)
                .catch(error => alert(error));
            }
        },
        mounted() {
            this.getCountry();
        }
    }
</script>
