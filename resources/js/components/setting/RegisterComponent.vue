<template>
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nom<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required v-model="form.name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Adresse E-mail<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" v-model="form.email" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Rôle<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <select  class="form-control" v-model="form.role">
                                    <option value="Commercial">Commercial</option>
                                    <option value="Comptable">Comptable</option>
                                    <option value="Admin">Admin</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Sexe<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <select  class="form-control" v-model="form.sexe">
                                    <option value="Homme">Homme</option>
                                    <option value="Femme">Femme</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Mot de passe<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required v-model="form.password">

                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Mot de passe de confirmation<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required v-model="form.password_confirmation">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button @click.prevent="register" class="btn btn-outline-success">
                                    Ajouter
                                </button>
                            </div>
                        </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data(){
        return{
            form:{
                name:null,
                email:null,
                password:null,
                password_confirmation:null,
                role:null,
                sexe:null
            }
        }
    },
    methods:{
        register(){
            if(this.notEmpty()){
                if(this.identicPassword()){
                     axios.post('/api/register', this.form)
                    // .then(response => this.$router.push({path:"/login"}))
                    .then(response => {this.$emit('userAdded', response.data), 
            this.showAlert('L\'utilisateur a été ajouté', 'success');})
                    .catch(error => alert(error));
                }else{
                    this.showAlert('Les deux mots de passe sont différents', 'error');
                }
            }else{
                this.showAlert('Tous les champs (*) sont obligatoires', 'error');
            }
           
        },
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
        notEmpty(){
            if(this.form.name === null || this.form.email === null || this.form.password === null || this.form.password_confirmation === null || this.form.role === null || this.form.sexe === null){
                return false;
            }else{
                return true;
            }
        },
        identicPassword(){
            if(this.form.password !== this.form.password_confirmation){
                return false;
            }else{
                return true;
            }
        }
    }
}
</script>

<style>

</style>
