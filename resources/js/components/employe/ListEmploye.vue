<template>
    <div class="row">
        <edit-employed v-on:employeUpdated="refresh" v-bind:emp="empEditing"></edit-employed>
        <info-employed v-bind:emp="empEditing"></info-employed>
        <div class="col-md-3" v-for="em in emps" :key="em.id">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-info">
                    <h3 class="widget-user-username">{{em.prenom}} {{em.nom}}</h3>
                    <h5 class="widget-user-desc">{{em.fonction}}</h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle elevation-2" src="dist/img/user1-128x128.jpg" alt="User Avatar">
                    <button class="btn round btn-outline-info editAvatar" @click="editImage"> <i class="fas fa-edit" ></i></button>
                </div>
                <div class="card-footer">
                    <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <span class="description-text">
                                <button class="btn btn-info btn-rounded"  data-toggle="modal" data-target="#infoEmployed" @click="getEmp(em.id)"><i class="fa fa-eye" aria-hidden="true" ></i></button>
                            </span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <span class="description-text">
                                <button class="btn btn-warning btn-rounded"  data-toggle="modal" data-target="#editEmployed" @click="getEmp(em.id)"><i class="fa fa-edit" aria-hidden="true" ></i></button>
                            </span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                        <div class="description-block">
                        <span class="description-text">
                            <button class="btn btn-danger btn-rounded" @click="deleteEmp(em.id)"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
            refresh(){
                axios.get('/api/employe')
                .then(response => this.emps = response.data)
                .catch(error => alert(error));
            },
            getEmp(id){
                axios.get('/api/employe/show-'+id)
                .then(response => this.empEditing = response.data)
                .catch(error => alert(error));
            },
            deleteEmp(id){
                axios.delete('/api/employe/'+id)
                .then(response => this.emps = response.data)
                .catch(error => alert(error));
            },
            editImage(){
                alert('bien');
            }
        }
    }
</script>
