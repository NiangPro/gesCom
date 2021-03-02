<template>
    <div class="row">
            <edit-prospect v-on:prospectUpdated="refresh" :form="prospectEditing" ></edit-prospect>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card" id="tabcli">
                    <div class="card-header">
                        <h5 class="mb-0">Liste des prospects </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sujet</th>
                                        <th>Source</th>
                                        <th>Assigné à</th>
                                        <th>Pays</th>
                                        <th>Adresse</th>
                                        <th>Email</th>
                                        <th>Tel</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="p in prospects" :key="p.id">
                                            <td>{{p.sujet}}</td>
                                            <td>{{p.source}}</td>
                                            <td>{{p.assignation}}</td>
                                            <td>{{p.pays}}</td>
                                            <td>{{p.adresse}}</td>
                                            <td>{{p.email}}</td>
                                            <td>{{p.tel}}</td>
                                        <td> <button class="btn btn-warning rounded mr-2" data-toggle="modal" data-target="#editProspect" @click="getProspect(p.id)"><i class="fa fa-edit" aria-hidden="true"></i></button><button class="btn btn-danger rounded" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ?')" @click="deleteProspect(p.id)"><i class="fa fa-trash" aria-hidden="true"></i></button> </td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
export default {
    props:['prospects'],
    data(){
        return {
            prospectEditing:null
        }
    },
    methods:{
        getProspect(id){
            axios.get('/api/prospect/show-'+id)
            .then(response => this.prospectEditing = response.data)
            .catch(error => alert(error));
        },
        refresh(prospects){
            this.prospects = prospects;
        },
        deleteProspect(id){
            axios.delete('/api/prospect/'+id)
            .then(response => this.prospects = response.data)
            .catch(error => alert(error));
        }
    }
}
</script>
