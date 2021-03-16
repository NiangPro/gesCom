<template>
    <div>
        <form enctype="multipart/form-data">
            <div class="row">
                <div class="form-group col-3 pt-5">
                    <label for="">Nom du site</label>
                    <input type="text"  class="form-control" v-model="appname" @change="changeName">
                </div>

                <div class="col">
                    <label for="" class="pt-5">Logo</label>
                    <div class="row">
                        <div class="custom-file col ">
                            <input type="file" class="custom-file-input" @change="changeLogo"   name="image">
                            <label for="image" class="custom-file-label">Selectionner une image</label>
                        </div>
                        <div class="text-center col" style="margin-top:-50px;">
                            <img :src="imgLogo"class="figure-img img-fluid rounded" alt="" style="max-height:100px;">
                        </div>

                    </div>
                </div>

                <div class="col">
                    <label for="" class="pt-5">Favicon</label>
                    <div class="row">
                        <div class="custom-file col ">
                            <input type="file" class="custom-file-input" @change="changeIcon" name="image">
                            <label for="image" class="custom-file-label">Selectionner une image</label>
                        </div>
                        <div class="text-center col" style="margin-top:-50px;">
                            <img :src="imgIcon" class="figure-img img-fluid rounded" alt="" style="max-height:100px;">
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-right m-3">
                    <button @click.prevent="saveChanges" class="btn btn-outline-primary btn-sm text-right">Enregistrer les modification</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return {
            donnees:{},
            form:{
                name:null,
                logo:null,
                favicon:null
            },

            appname:null,
            imgLogo:null,
            imgIcon:null
        }
    },
    methods:{
        changeIcon(e){
            this.form.favicon = e.target.files[0];

            let reader = new FileReader();

            reader.readAsDataURL(this.form.favicon);

            reader.onload = e =>{
                this.imgIcon = e.target.result
            }
        },
        changeLogo(e){
            this.form.logo = e.target.files[0];

            let reader = new FileReader();

            reader.readAsDataURL(this.form.logo);

            reader.onload = e =>{
                this.imgLogo = e.target.result
            }
        },
        changeName(){
            this.form.name = this.appname;
        },
        notNull(){
            if(this.form.name === null && this.form.logo === null && this.form.favicon === null){
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
                    let data = new FormData();
                    data.append('logo', this.form.logo);
                    data.append('icon', this.form.favicon);
                    this.nameTesting(data);
                    axios.post('/api/changevars', data)
                    .then(response => {this.donnees = response.data, this.showAlert('Les informations ont été mises à jour, Actualisez pour voir les modifications', 'success')})
                }else{
                    this.showAlert('Aucun changement a été effectué', 'error');
                }
            }
        },
        getVars(){
            axios.get('/api/appvars')
            .then(response => {this.donnees = response.data, this.init()})
            .catch(error => alert(error));
        },
        nameTesting(data){
            if(this.form.name !== null && this.form.name !== ''){
                data.append('appname', this.form.name);
            }
        },
        init(){
            this.appname = this.donnees.name;
            this.imgLogo = 'storage/images/'+this.donnees.logo;
            this.imgIcon = 'storage/images/'+this.donnees.icon;
        }
    },
    created(){
        this.getVars();
    }

}
</script>

<style>

</style>
