<template>
    <div>
        <edit-staticdata v-on:sdUpdated="getList" :staticData="sdEditing"></edit-staticdata>

        <div class="card card-light collapsed-card" v-for="(item, index) in staticDatas" :key="index">
              <div class="card-header" data-card-widget="collapse">
                <h3 class="card-title" >{{index}}</h3>
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                <div class="card-tools">

                  <button type="button" class="btn btn-outline-success toastrDefaultInfo" data-toggle="modal" data-target="#addStaticData" @click="addNew(index)">
                                Ajouter
                </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                 <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Label</th>
                    <th>Valeur</th>
                    <th>Statut</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                     <tr v-for="sd in item" :key="sd.id">


                    <td>{{sd.label}}</td>
                    <td>{{sd.valeur}}</td>
                    <td>
                       <!-- <input type="checkbox" @click="changeStatus(sd.id)" v-if="sd.statut == 1" checked>
                       <input type="checkbox" @click="changeStatus(sd.id)" v-if="sd.statut == 0"> -->
                       <div class="form-group">
                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                            <input type="checkbox" class="custom-control-input" :id="`customSwitch`+sd.id" @click="changeStatus(sd.id)" v-if="sd.statut == 1" checked>
                            <input type="checkbox" class="custom-control-input" :id="`customSwitch`+sd.id" @click="changeStatus(sd.id)" v-if="sd.statut == 0">
                            <label class="custom-control-label" :for="`customSwitch`+sd.id"></label>
                            </div>
                        </div>
                </td>
                    <td><button class="btn btn-outline-primary btn-sm rounded mr-3" data-toggle="modal" data-target="#editStaticData" @click="getSd(sd.id)"><i class="fa fa-edit" aria-hidden="true"></i></button>
                    <button class="btn btn-outline-danger btn-sm rounded"  @click="deleteSd(sd.id)"><i class="fa fa-trash"  aria-hidden="true"></i></button></td>
                  </tr>
                  </tbody>
                </table>

              </div>
              <!-- /.card-body -->
            </div>

    </div>
</template>

<script>
export default{
    props:['staticDatas'],
    data(){
        return {
            sdEditing:''
        }
    },

        methods:{
            changeStatus(id){
                axios.get('/api/changeStatusStaticData/'+id)
                .then(response => {this.staticDatas = response.data, this.showAlert('Le statut de la donnée statique a été changé')})
                .catch(error => alert(error));
            },
            deleteSd(id){
                if(confirm('Êtes-vous sûr de vouloir supprimer ?')){
                axios.delete('/api/staticdata/'+id)
                .then(response => {this.staticDatas = response.data, this.showAlert('La donnée statique a été supprimée')})
                .catch(error => alert(error));
                }else{
                    this.showAlert('L\'opération a été annulée');
                }
            },
            rmSpace(chaine){
                let tab = chaine.split(" ");

                return tab.join("");
            },
            getSd(id){
                axios.get('/api/staticdata/show-'+id)
                .then(response => this.sdEditing = response.data)
                .catch(error => alert(error));
            },
            getList(sd){
               this.staticDatas = sd;
               this.showAlert('La donnée statique a été bien modifiée');
            },
            addNew(type){
                this.$emit('addNew', type);
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
            }
        }

    }
</script>
