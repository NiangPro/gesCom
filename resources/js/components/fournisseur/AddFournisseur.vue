<template>
    <div class="modal fade" id="addFr">
        <div class="modal-dialog">
          <div class="modal-content ">
            <div class="modal-header">
              <h4 class="modal-title">Ajout Fournisseur</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <form>
            <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="form-control" placeholder="Entrer le prénom" v-model="form.prenom">
                        </div>
                        <div class="form-group col-md-6">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" placeholder="Entrer le nom" v-model="form.nom">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" placeholder="Entrer l'adresse email" v-model="form.email">
                        </div>
                        <div class="form-group col-md-6">
                        <label for="tel">Telephone</label>
                        <input type="text" class="form-control"  placeholder="Entrer le numéro de telephone" v-model="form.tel">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <input type="text" class="form-control" placeholder="Entrer l'adresse" v-model="form.adresse">
                    </div>


                    <div class="form-group">
                        <label for="fonction">Pays</label>
                        <select  class="form-control" v-model="form.pays">
                            <option v-for="p in pays" :key="p.id" v-bind:value="p.nom_fr">{{p.nom_fr}}</option>
                        </select>
                    </div>
                </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fermer</button>
              <button type="button" class="btn btn-outline-info" data-dismiss="modal" @click="addFr()">Ajouter</button>
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
                prenom:'',
                nom:'',
                pays:'',
                tel:'',
                email:'',
                adresse:''
            },
            pays:{}
        }
    },
    methods:{
        getCountry(){
            axios.get('/api/pays')
            .then(response => this.pays = response.data)
            .catch(error => alert(error));
        },
        addFr(){
            axios.post('/api/fournisseur', {
                    prenom: this.form.prenom,
                    nom: this.form.nom,
                    email: this.form.email,
                    tel: this.form.tel,
                    adresse: this.form.adresse,
                    pays: this.form.pays
                })
                .then(response => {this.$emit('frAdded', response.data), this.initForm()})
                .catch(error => alert(error));
        },
        initForm(){
            this.form.prenom='';
            this.form.nom='';
            this.form.pays='';
            this.form.tel='';
            this.form.email='';
            this.form.adresse='';
        }
    },
    mounted(){
        this.getCountry();
    }
}
</script>
