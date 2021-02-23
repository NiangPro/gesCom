<template>
    <div class="row">
        <edit-employed @employeUpdated="refresh" :emp="empEditing"></edit-employed>
        <info-employed :emp="empEditing"></info-employed>
        <edit-profil :emp="empEditing"></edit-profil>
        <div class="col-md-3" v-for="em in emps" :key="em.id">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-primary">
                    <h3 class="widget-user-username">{{em.prenom}} {{em.nom}}</h3>
                    <h5 class="widget-user-desc">{{em.fonction}}</h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle elevation-2" src="images/user.png" alt="User Avatar">
                    <i class="fas fa-edit tools" data-toggle="modal" data-target="#editProfil" @click="getEmp(emp.id)"></i>
                </div>
                <div class="card-footer">
                    <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <span class="description-text">
                                <button class="btn btn-success btn-rounded btn-sm"  data-toggle="modal" data-target="#infoEmployed" @click="getEmp(em.id)"><i class="fa fa-eye" aria-hidden="true" ></i></button>
                            </span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <span class="description-text">
                                <button class="btn btn-warning btn-rounded btn-sm"  data-toggle="modal" data-target="#editEmployed" @click="getEmp(em.id)"><i class="fa fa-edit" aria-hidden="true" ></i></button>
                            </span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                        <div class="description-block">
                        <span class="description-text">
                            <button class="btn btn-danger btn-rounded btn-sm" @click="deleteEmp(em.id)"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
                empEditing: {}
            }
        },
        methods:{
            refresh(emps){
               this.emps = emps;
               this.showAlert('Les informations de l\'employé ont été mises en jour');
            },
            getEmp(id){
                axios.get('/api/employe/show-'+id)
                .then(response => this.empEditing = response.data)
                .catch(error => alert(error));
            },
            deleteEmp(id){
                axios.delete('/api/employe/'+id)
                .then(response => {this.emps = response.data, this.showAlert('L\'employé a été supprimé')})
                .catch(error => alert(error));
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
