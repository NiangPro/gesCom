<template>
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Connexion</div>

                <div class="card-body">
                    <form>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Adresse E-mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" required autofocus v-model="form.email">

                                <span class="invalid-feedback" role="alert" v-if="errors.email">
                                        <strong>{{ errors.email[0] }}</strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Mot de passe</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" v-model="form.password" required>

                                <span class="invalid-feedback" role="alert" v-if="errors.password">
                                        <strong>{{ errors.password[0] }}</strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Se connecter
                                </button>
                            </div>
                        </div>
                    </form>
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
                email:null,
                password:null
            },
            errors:[]
        }
    },
    methods:{
        login(){
            axios.post('/api/login', this.form)
            .then(response => this.$router.push({name: "Dashboard"}))
            .catch(error => this.errors = error.response.data.errors);
        }
    }
}
</script>

<style>

</style>
