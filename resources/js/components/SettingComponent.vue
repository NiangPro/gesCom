<template>
   <div>
        <entete :subTitle="subTitle" :title="title"></entete>

        <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item col">
                        <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Profil</a>
                    </li>
                    <li class="nav-item col" v-if="user.role === 'Admin'" >
                        <a class="nav-link " id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Paramètres Généraux</a>
                    </li>

                    <li class="nav-item col">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Mot de passe</a>
                    </li>
                    <li class="nav-item col" v-if="user.role === 'Admin'" >
                        <a class="nav-link" id="pills-users-tab" data-toggle="pill" href="#pills-users" role="tab" aria-controls="pills-users" aria-selected="false">Utilisateurs</a>
                    </li>
                    <li class="nav-item col" v-if="user.role === 'Admin'" >
                        <a class="nav-link" id="pills-user-tab" data-toggle="pill" href="#pills-user" role="tab" aria-controls="pills-user" aria-selected="false">Ajout utilisateur</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <profil-user></profil-user>
                    </div>
                    <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <edit-setting></edit-setting>
                    </div>

                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <edit-password></edit-password>
                    </div>
                    <div class="tab-pane fade" id="pills-users" role="tabpanel" aria-labelledby="pills-users-tab">
                        <list-users :users="users"></list-users>
                    </div>
                    <div class="tab-pane fade" id="pills-user" role="tabpanel" aria-labelledby="pills-user-tab">
                        <add-user @userAdded="refresh"></add-user>
                    </div>
                </div>
            </div>
        </div>
    </div>
   </div>
</template>

<script>
export default {
    data(){
        return {
            title:'Paramètres',
            subTitle:'/Paramètres',
            users:null,
            user:null
        }
    },
    methods:{
        showAlert(message) {
        // Use sweetalert2
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                })

                Toast.fire({
                icon: 'success',
                title: message
                })
        },
        refresh(users){
            this.users = users;
            this.showAlert('L\'utilisateur a été ajouté');
        },
        getUsers(){
            axios.get('/api/users')
            .then(response => this.users = response.data)
            .catch(error => alert(error));
        },
        getUser(){
            axios.get('/api/userConnected')
            .then(response => {this.user = response.data})
            .catch(error => alert(error));
        }
    },
    mounted(){
        this.getUsers();
        this.getUser();
    }
}
</script>

<style>

</style>
