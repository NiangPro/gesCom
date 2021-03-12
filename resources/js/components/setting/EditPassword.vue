<template>
    <div>
        <form>
            <div class="row">
                <div class="form-group col">
                    <label for="">Mot de passe actuel</label>
                    <input type="password"  class="form-control" v-model="form.password">
                </div>
                <div class="form-group col">
                    <label for="">Nouveau Mot de passe</label>
                    <input type="password" class="form-control" v-model="form.password_edit">
                </div>
                <div class="form-group col">
                    <label for="">Mot de passe de confirmation</label>
                    <input type="password" class="form-control" v-model="form.password_confirmation">
                </div>
            </div>
            <div class="row">
                <div class="col text-right m-3">
                    <button type="" class="btn btn-outline-primary btn-sm text-right">Enregistrer les modification</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return {
            form:{
                password: '',
                password_edit:'',
                password_confirmation:''
            }
        }
    }

}
</script>

<style>

</style>
