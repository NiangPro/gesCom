<template>
    <div>
        <form>
            <div class="row">
                <div class="form-group col">
                    <label for="">Nom du site</label>
                    <input type="text" placeholder="sunucode" class="form-control" v-model="form.name">
                </div>

                <div class="form-group col">
                    <label for="">Logo</label>
                    <input type="file" class="form-control">
                </div>
                <div class="form-group col">
                    <label for="">Favicon</label>
                    <input type="file" class="form-control">
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
                name:"sunucode",
                logo:null,
                favicon:null
            }
        }
    }

}
</script>

<style>

</style>
