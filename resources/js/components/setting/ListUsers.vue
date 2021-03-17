<template>
  <div class="row">
      <info-user :user="user" v-if="user"></info-user>
      <edit-anotherUser :user="user" v-if="user"></edit-anotherUser>
      <div class="col-md-3" v-for="user in users" :key="user.id">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-info">
                    <h3 class="widget-user-username">{{user.name}}</h3>
                    <h6 class="widget-user-desc">{{user.role}}</h6>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle elevation-2" :src="`/storage/images/`+user.avatar" alt="User Avatar">
                </div>
                <div class="card-footer">
                    <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <span class="description-text">
                                <button class="btn btn-outline-success btn-rounded btn-sm" title="Consulter" data-toggle="modal" data-target="#infoUser" @click="getUser(user.id)"><i class="fa fa-eye" aria-hidden="true" ></i></button>
                            </span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                        <span class="description-text">
                            <button class="btn btn-outline-primary btn-rounded btn-sm" data-toggle="modal"  data-target="#editPassword" @click="getUser(user.id)" title="Modifier le mot de passe"><i class="fa fa-edit" aria-hidden="true"></i></button>
                        </span>
                        </div>
                        <!-- /.description-block -->
                    </div>

                    <div class="col-sm-4">
                        <div class="description-block">
                        <span class="description-text">
                            <button class="btn btn-outline-danger btn-rounded btn-sm" @click="deleteUser(user.id)" title="Supprimer"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.widget-user -->
        </div>
  </div>
</template>

<script>
export default {
    props:['users'],
    data(){
        return {
            user:null
        }
    },
    methods:{
        getUser(id){
            axios.get('/api/user/'+id)
            .then(response => this.user = response.data)
            .catch(error => alert(error));
        },
        deleteUser(id){
            if(confirm('Êtes-vous sûr de vouloir supprimer ?')){
                axios.delete('/api/user/'+id)
                .then(response => {this.$emit('userDeleted', response.data), this.showAlert('L\'utilisateur a été supprimé', 'success')})
                .catch(error => alert(error));
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
        }

    }
}
</script>

<style>

</style>
