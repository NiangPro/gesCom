<template>
     <div class="modal fade" id="editEmployed">
        <div class="modal-dialog">
          <div class="modal-content ">
            <div class="modal-header">
              <h4 class="modal-title">Edition Employé</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <form>
            <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="form-control" placeholder="Entrer le prénom" v-model="emp.prenom">
                        </div>
                        <div class="form-group col-md-6">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control"  placeholder="Entrer le nom" v-model="emp.nom">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" placeholder="Entrer l'adresse email" v-model="emp.email">
                        </div>
                        <div class="form-group col-md-6">
                        <label for="tel">Telephone</label>
                        <input type="text" class="form-control"  placeholder="Entrer le numéro de telephone" v-model="emp.tel">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <input type="text" class="form-control" placeholder="Entrer l'adresse" v-model="emp.adresse">
                    </div>


                    <div class="form-group">
                        <label for="fonction">Fonction</label>
                        <select class="form-control" v-model="emp.fonction">
                            <option v-for="s in sd" :key="s.id" v-bind:value="s.valeur">{{s.valeur}}</option>
                        </select>
                    </div>
                </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fermer</button>
              <button type="button" class="btn btn-outline-info" @click="editEmploye()" data-dismiss="modal">Modifier</button>
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
        props:['emp'],
        data(){
            return {
                sd:{}
            }
        },
        methods:{
            editEmploye(){
                axios.patch('/api/employe/edit-'+this.emp.id, {
                    prenom: this.emp.prenom,
                    nom: this.emp.nom,
                    email: this.emp.email,
                    tel: this.emp.tel,
                    adresse: this.emp.adresse,
                    fonction: this.emp.fonction
                })
                .then(response => this.$emit('employeUpdated', response.data))
                .catch(error => alert(error));
            },
            getSd(){
                axios.get('/api/staticdata/fonction')
                .then(response => this.sd = response.data)
                .catch(error => alert(error));
            }
        },
        mounted() {
            this.getSd();
        }
    }
</script>
