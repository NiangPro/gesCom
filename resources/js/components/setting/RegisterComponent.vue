<template>
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nom</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required v-model="form.name" autofocus>

                                <span class="invalid-feedback" role="alert" v-if="errors.name">
                                        <strong>{{ errors.name[0] }}</strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Adresse E-mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" v-model="form.email" required>

                                <span class="invalid-feedback" role="alert" v-if="errors.email">
                                        <strong>{{ errors.email[0] }}</strong>
                                </span>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Rôle</label>

                            <div class="col-md-6">
                                <select  class="form-control" v-model="form.role">
                                    <option value="Commercial">Commercial</option>
                                    <option value="Comptable">Comptable</option>
                                    <option value="Admin">Admin</option>
                                </select>
                                <span class="invalid-feedback" role="alert" v-if="errors.role">
                                        <strong>{{ errors.role[0] }}</strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Sexe</label>

                            <div class="col-md-6">
                                <select  class="form-control" v-model="form.sexe">
                                    <option value="Homme">Homme</option>
                                    <option value="Femme">Femme</option>
                                </select>
                                <span class="invalid-feedback" role="alert" v-if="errors.sexe">
                                        <strong>{{ errors.sexe[0] }}</strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Mot de passe</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required v-model="form.password">

                                <span class="invalid-feedback" role="alert" v-if="errors.password">
                                        <strong>{{ errors.password[0] }}</strong>
                                    </span>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Mot de passe de confirmation</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required v-model="form.password_confirmation">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button @click="register" class="btn btn-outline-success">
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
            },
            errors:[]
        }
    },
    methods:{
        register(){
            axios.post('/api/register', this.form)
            // .then(response => this.$router.push({path:"/login"}))
            .then(response => this.$emit('userAdded', response.data))
            .catch(error => this.errors = error.response.data.errors);
        }
    }
}
</script>

<style>

</style>
