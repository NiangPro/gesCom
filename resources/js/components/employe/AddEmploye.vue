<template>
     <div class="modal fade" id="addEmployed">
        <div class="modal-dialog">
          <div class="modal-content ">
            <div class="modal-header">
              <h4 class="modal-title">Ajout Employé</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <form>
            <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="prenom">Prénom<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Entrer le prénom" v-model="form.prenom">
                        </div>
                        <div class="form-group col-md-6">
                        <label for="nom">Nom<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Entrer le nom" v-model="form.nom">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="email">Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" placeholder="Entrer l'adresse email" v-model="form.email">
                        </div>
                        <div class="form-group col-md-6">
                        <label for="tel">Telephone<span class="text-danger">*</span></label>
                        <input type="text" class="form-control"  placeholder="Entrer le numéro de telephone" v-model="form.tel">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Entrer l'adresse" v-model="form.adresse">
                    </div>


                    <div class="form-group">
                        <label for="fonction">Fonction<span class="text-danger">*</span></label>
                        <select  class="form-control" v-model="form.fonction">
                            <option v-for="s in sd" :key="s.id" v-bind:value="s.valeur">{{s.valeur}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fonction">Sexe<span class="text-danger">*</span></label>
                        <select  class="form-control" v-model="form.sexe">
                            <option value="Homme">Homme</option>
                            <option value="Femme">Femme</option>
                        </select>
                    </div>
                </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fermer</button>
              <button type="button" class="btn btn-outline-success" @click="addEmploye()" data-dismiss="modal">Ajouter</button>
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
                    prenom: '',
                    nom: '',
                    email: '',
                    tel: '',
                    adresse: '',
                    fonction: '',
                    sexe: ''
                },
                sd:{}
            }
        },
        methods:{
            addEmploye(){
                if(this.notEmpty()){
                axios.post('/api/employe', this.form)
                .then(response => {this.$emit('employeAdded', response.data)})
                .catch(error => alert(error));
                }else{
                    this.$emit('errorAdded');
                }
            },
            getSd(){
                axios.get('/api/staticdata/fonction')
                .then(response => this.sd = response.data)
                .catch(error => alert(error));
            },
            notEmpty(){
                if(this.form.prenom === '' || this.form.nom === '' || this.form.email === '' || this.form.tel === '' || this.form.adresse === '' || this.form.sexe === '' || this.form.fonction === ''){
                    return false;
                }else{
                    return true;
                }
            }
        },
        mounted() {
            this.getSd();
        }
    }
</script>
