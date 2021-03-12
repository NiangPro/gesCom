<template>
  <div class="container col-md-10">
      <edit-avatar :userEditing="user" @avatarUploaded="avatarUpload" @imageError="avatarNull"></edit-avatar>
      <div class="row">
            <div class="col-md-4">
               <div class="widget-user-image">
                    <img class="img-circle elevation-2" style="height:250px;width:250px" :src="`/storage/images/`+user.avatar" alt="User Avatar">
                    <i class="fas fa-edit tools" title="Changer le photo de profil" data-toggle="modal" data-target="#editProfil"  style="color:orange"></i>
                </div>
            </div>
          <div class="col-md-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Nom</span>
                    </div>
                    <input type="text" class="form-control" v-model="form.name">
                </div><br>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Email</span>
                    </div>
                    <input type="email" class="form-control" v-model="form.email">
                </div><br>
                <div class="input-group"  v-if="form.role === 'Admin'" >
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Rôle</span>
                    </div>
                    <select class="form-control" v-model="form.role">
                        <option value="Commercial">Commercial</option>
                        <option value="Comptable">Comptable</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div><br>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Sexe</span>
                    </div>
                    <select class="form-control" v-model="form.sexe">
                        <option value="Homme">Homme</option>
                        <option value="Femme">Femme</option>
                    </select>
                </div><br>
                <button class="btn btn-outline-success" @click="update">Mettre à jour</button>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    data(){
        return {
            user:{},
            form:{
                name:'',
                email:'',
                role:'',
                sexe:''
            }
        }
    },
    methods:{
        avatarUpload(user){
            this.user = user;
            this.showAlert('Votre profil a été modifié', 'success');
        },
        avatarNull(){
            this.showAlert('Vous n\'avez pas selectionné une image', 'error');
        },
        getUser(){
            axios.get('/api/userConnected')
            .then(response => {this.user = response.data, this.initForm()})
            .catch(error => alert(error));
        },
        initForm(){
            this.form.name = this.user.name;
            this.form.email = this.user.email;
            this.form.role = this.user.role;
            this.form.sexe = this.user.sexe;
        },
        update(){
            axios.patch('/api/user/'+this.user.id, this.form)
            .then(response => {this.user = response.data, this.initForm(), this.showAlert('Vos informations ont été mises à jour', 'success')})
            .alert(error => alert(error));
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
        }
    },
    mounted(){
        this.getUser();
    }
}
</script>

<style>

</style>
