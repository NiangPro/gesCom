<template>
    <div>
        <form>
            <div class="row">
                <div class="form-group col">
                    <label for="">Nouveau Mot de passe</label>
                    <input type="password" class="form-control" v-model="form.password_edit">
                </div>
                <div class="form-group col">
                    <label for="">Mot de passe de confirmation</label>
                    <input type="password" class="form-control" v-model="form.password_confirmation">
                </div>
                <div class="col mt-4">
                    <button class="btn btn-outline-success text-right" @click.prevent="editPassword">Enregistrer les modification</button>
                </div>
            </div>
        </form>
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
