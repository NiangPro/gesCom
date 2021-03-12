<template>
    <div class="row">
        <edit-employed v-if="etat == 'edit'" @employeUpdated="refresh" :emp="empEditing"></edit-employed>
        <info-employed v-if="etat == 'info'" :empInfo="empEditing"></info-employed>
        <edit-profil v-if="etat == 'profil'" :empProfil="empEditing" @profilUpload="photo"></edit-profil>
        <div class="col-md-3" v-for="em in emps" :key="em.id">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-primary">
                    <h3 class="widget-user-username">{{em.prenom}} {{em.nom}}</h3>
                    <h6 class="widget-user-desc">{{em.fonction}}</h6>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle elevation-2" :src="`/storage/images/`+em.profil" alt="User Avatar">
                    <i class="fas fa-edit tools" title="Changer le photo de profil" data-toggle="modal" data-target="#editProfil" @click="getEmp(em.id, 'profil')" style="color:orange"></i>
                </div>
                <div class="card-footer">
                    <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <span class="description-text">
                                <button class="btn btn-outline-success btn-rounded btn-sm" title="Consulter" data-toggle="modal" data-target="#infoEmployed" @click="getEmp(em.id, 'info')"><i class="fa fa-eye" aria-hidden="true" ></i></button>
                            </span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <span class="description-text">
                                <button class="btn btn-outline-primary btn-rounded btn-sm" title="Editer" data-toggle="modal" data-target="#editEmployed" @click="getEmp(em.id, 'edit')"><i class="fa fa-edit" aria-hidden="true" ></i></button>
                            </span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                        <div class="description-block">
                        <span class="description-text">
                            <button class="btn btn-outline-danger btn-rounded btn-sm" title="Supprimer" @click="deleteEmp(em.id)"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
export default{
        props:['emps'],
        data(){
            return {
                empEditing: null,
                etat:null,
            }
        },
        methods:{
            refresh(emps){
               this.emps = emps;
               this.showAlert('Les informations de l\'employé ont été mises en jour');
            },
            getEmp(id, etat){
                axios.get('/api/employe/show-'+id)
                .then(response => {this.empEditing = response.data, this.etat = etat})
                .catch(error => alert(error));
            },
            deleteEmp(id){
                if(confirm('Êtes-vous sûr de vouloir supprimer ?')){
                axios.delete('/api/employe/'+id)
                .then(response => {this.emps = response.data, this.showAlert('L\'employé a été supprimé')})
                .catch(error => alert(error));
                }else{
                    this.showAlert('L\'opération a été annulée');
                }
            },
            photo(emps){
                this.emps = emps;
               this.showAlert('L\'image du profil de l\'employé a été mise en jour');
            },
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
            editProfil(){}
            // editProfil(){
            //     const { value: file } = await Swal.fire({
            //     title: 'Selectionner une image',
            //     input: 'file',
            //     inputAttributes: {
            //         'accept': 'image/*',
            //         'aria-label': 'Upload your profile picture'
            //     }
            //     })

            //     if (file) {
            //     const reader = new FileReader()
            //     reader.onload = (e) => {
            //         Swal.fire({
            //         title: 'Your uploaded picture',
            //         imageUrl: e.target.result,
            //         imageAlt: 'The uploaded picture'
            //         })
            //     }
            //     reader.readAsDataURL(file)
            //     }
            // }
        }
    }
</script>
