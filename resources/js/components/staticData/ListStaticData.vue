<template>
    <div>
        <edit-staticdata v-on:sdUpdating="getList" v-bind:staticData="sdEditing"></edit-staticdata>

        <div class="card" v-for="(item, index) in staticDatas" :key="index">
            <div class="card-header" v:bind:id="`heading`+rmSpace(index)" data-toggle="collapse" v-bind:data-target="`#collapse` + rmSpace(index)" aria-expanded="false" v-bind:aria-controls="`collapse`+rmSpace(index)">
                <div class="row" >
                    <div class="col-md-6">
                            <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" v-bind:data-target="`#collapse` + rmSpace(index)" aria-expanded="false" v-bind:aria-controls="`collapse`+rmSpace(index)">
                            {{index}}
                            </button>
                        </h5>
                    </div>
                    <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-info toastrDefaultInfo" data-toggle="modal" data-target="#addStaticData">
                                Ajouter
                        </button>
                    </div>
                </div>


            </div>
            <div v-bind:id="`collapse`+rmSpace(index)" class="collapse" v-bind:aria-labelledby="`heading`+rmSpace(index)" data-parent="#accordionExample">
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
                        <div class="switch-button switch-button-success">
                            <input type="checkbox" v-bind:name="`switch`+sd.id" v-bind:id="`switch`+sd.id" >
                            <span>
                                <label v-bind:for="`switch`+sd.id"></label></span>
                    </div></td>
                    <td><button class="btn btn-warning rounded mr-3" data-toggle="modal" data-target="#editStaticData" @click="getSd(sd.id)"><i class="fa fa-edit" aria-hidden="true"></i></button>
                    <button class="btn btn-danger rounded" @click="deleteSd(sd.id)"><i class="fa fa-trash"  aria-hidden="true"></i></button></td>
                  </tr>
                  </tbody>
                </table>

            </div>
            </div>
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
            deleteSd(id){
                axios.delete('/api/staticdata/'+id)
                .then(response => this.staticDatas = response.data)
                .catch(error => alert(error));
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
            getList(){
                axios.get('/api/staticdata')
                .then(response => this.staticDatas = response.data)
                .catch(error => alert(error));
            }
        }

    }
</script>
