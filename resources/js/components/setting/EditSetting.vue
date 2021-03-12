<template>
    <div>
        <form enctype="multipart/form-data">
            <div class="row">
                <div class="form-group col-3 pt-5">
                    <label for="">Nom du site</label>
                    <input type="text"  class="form-control" v-model="form.name">
                </div>

                <div class="col">
                    <label for="" class="pt-5">Logo</label>
                    <div class="row">
                        <div class="custom-file col ">
                            <input type="file" class="custom-file-input"  name="image">
                            <label for="image" class="custom-file-label">Selectionner une image</label>
                        </div>
                        <div class="text-center col" style="margin-top:-50px;">
                            <img :src="form.logo" class="figure-img img-fluid rounded" alt="" style="max-height:100px;">
                        </div>

                    </div>
                </div>

                <div class="col">
                    <label for="" class="pt-5">Favicon</label>
                    <div class="row">
                        <div class="custom-file col ">
                            <input type="file" class="custom-file-input"  name="image">
                            <label for="image" class="custom-file-label">Selectionner une image</label>
                        </div>
                        <div class="text-center col" style="margin-top:-50px;">
                            <img :src="form.favicon" class="figure-img img-fluid rounded" alt="" style="max-height:100px;">
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-right m-3">
                    <button @click="saveChanges" class="btn btn-outline-primary btn-sm text-right">Enregistrer les modification</button>
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
                logo:"storage/images/logo.png",
                favicon:"storage/images/icon.png"
            },
            appname:null,
            imgLogo:null,
            imgIcon:null
        }
    },
    methods:{
        notNull(){
            if(this.appname === null && this.imgLogo === null && this.imgIcon === null){
                return false;
            }else{
                return true;
            }
        },
        showAlert(message, type) {
        // Use sweetalert2
           const Toast = Swal.mixin({
            toast: true,
            position: 'top-center',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
            })

            Toast.fire({
            icon: type,
            title: message
            })
        },
        saveChanges(){
            if(confirm('Êtes-vous sûr')){
                if(this.notNull()){
                    this.showAlert('Les informations ont été mises à jour', 'success')
                }else{
                    this.showAlert('Aucun changement a été effectué', 'error');
                }
            }
        }
    }

}
</script>

<style>

</style>
