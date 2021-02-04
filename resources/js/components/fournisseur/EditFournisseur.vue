<template>
     <div class="modal fade" id="editFr">
        <div class="modal-dialog">
          <div class="modal-content ">
            <div class="modal-header">
              <h4 class="modal-title">Edition Fournisseur</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <form>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control"  placeholder="Entrer le nom" v-model="fr.nom">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" placeholder="Entrer l'adresse email" v-model="fr.email">
                        </div>
                        <div class="form-group col-md-6">
                        <label for="tel">Telephone</label>
                        <input type="text" class="form-control"  placeholder="Entrer le numéro de telephone" v-model="fr.tel">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <input type="text" class="form-control" placeholder="Entrer l'adresse" v-model="fr.adresse">
                    </div>

                    <div class="form-group">
                        <label for="fonction">Pays</label>
                        <select  class="form-control" v-model="fr.pays">
                            <option v-for="p in pays" :key="p.id" v-bind:value="p.nom_fr">{{p.nom_fr}}</option>
                        </select>
                    </div>
                </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fermer</button>
              <button type="button" class="btn btn-outline-info" @click="editFr()" data-dismiss="modal">Modifier</button>
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
        props:['fr'],
        data(){
            return {
                pays:{}
            }
        },
        methods:{
            editFr(){
                axios.patch('/api/fournisseur/edit-'+this.fr.id, this.fr)
                .then(response => this.$emit('frUpdated', response.data))
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
