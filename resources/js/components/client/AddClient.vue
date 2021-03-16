<template>
    <div class="modal fade" id="addClient">
        <div class="modal-dialog">
          <div class="modal-content ">
            <div class="modal-header">
              <h4 class="modal-title">Ajout Client</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <form>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="nom">Nom<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Entrer le nom" v-model="form.nom">
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
                        <label for="fonction">Pays<span class="text-danger">*</span></label>
                        <select  class="form-control" v-model="form.pays">
                            <option v-for="p in pays" :key="p.id" v-bind:value="p.nom_fr">{{p.nom_fr}}</option>
                        </select>
                    </div>
                </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fermer</button>
              <button type="button" class="btn btn-outline-info" data-dismiss="modal" @click="addClient()">Ajouter</button>
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
                pays:'',
                tel:'',
                email:'',
                adresse:''
            },
            pays:null
        }
    },
    methods:{
        getCountry(){
            axios.get('/api/pays')
            .then(response => this.pays = response.data)
            .catch(error => alert(error));
        },
        addClient(){
            if(this.notEmpty()){
            axios.post('/api/client', this.form)
                .then(response => {this.$emit('clientAdded', response.data), this.initForm(), this.showAlert('Client ajouté avec succès')})
                .catch(error => alert(error));
            }else{
                this.$emit('errorAdded');
            }
        },
        initForm(){
            this.form.prenom='';
            this.form.nom='';
            this.form.pays='';
            this.form.tel='';
            this.form.email='';
            this.form.adresse='';
        },
        notEmpty(){
            if(this.form.prenom === '' || this.form.nom === '' || this.form.pays === '' || this.form.tel === '' || this.form.email === '' || this.form.adresse === ''){
                return false;
            }

            return true;
        },
        showAlert(message) {
        // Use sweetalert2
           const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
            })

            Toast.fire({
            icon: 'success',
            title: message
            })
        }
    },
    mounted(){
        this.getCountry();
    }
}
</script>
