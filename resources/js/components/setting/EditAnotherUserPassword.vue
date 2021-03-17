<template>
    <div class="modal fade" id="editPassword">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title">Changement de mot de passe</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="form-group">
                        <label for="">Nouveau Mot de passe<span class="text-danger">*</span></label>
                        <input type="password" class="form-control" v-model="form.password_edit">
                    </div>
                    <div class="form-group">
                        <label for="">Mot de passe de confirmation<span class="text-danger">*</span></label>
                        <input type="password" class="form-control" v-model="form.password_confirmation">
                    </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button class="btn btn-outline-success text-right" data-dismiss="modal" @click.prevent="editPassword">Enregistrer les modification</button>
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
    props:['user'],
    data(){
        return {
            form:{
                password_edit:'',
                password_confirmation:'',
                iduser: this.user.id
            }
        }
    },
    methods:{
        showAlert(message, type) {
        // Use sweetalert2
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                })

                Toast.fire({
                icon: type,
                title: message
                })
        },
        testPassword(){
            if(this.form.password_edit === '' || this.form.password_confirmation === ''){
                this.showAlert('Veuillez saisir tous les champs', 'error');
                return false;
            }else if(this.form.password_edit !== this.form.password_confirmation){
                this.showAlert('Les deux mots de passe sont différents', 'error');
                return false;
            }else{
                return true;
            }
        },
        editPassword(){
            if(confirm('Êtes-vous sûr ?')){
                if(this.testPassword()){
                    axios.post('/api/user/edit', this.form)
                    .then(response => {this.showAlert('Mot de passe modifié avec succès', 'success'), this.form.password_edit = '', this.form.password_confirmation = '', this.user= response.data})
                    .catch(error => alert(error));
                }
            }
        }
    }

}
</script>

<style>

</style>
