<template>
    <div class="row">
            <edit-reunion v-on:reunionUpdated="refresh" :form="reunionEditing"></edit-reunion>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card" id="tabreunion">
                    <div class="card-header">
                        <h5 class="mb-0">Liste des Réunions </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="r in reunions" :key="r.id">
                                            <td>{{r.titre}}</td>
                                            <td>{{formattedDate(r.date)}}</td>
                                            <td>{{r.description}}</td>
                                        <td><button class="btn btn-warning rounded mr-2" data-toggle="modal" data-target="#editReunion" @click="getReunion(r.id)"><i class="fa fa-edit" aria-hidden="true"></i></button><button class="btn btn-danger rounded" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ?')" @click="deleteReunion(r.id)"><i class="fa fa-trash" aria-hidden="true"></i></button> </td>
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
import { formatRelative } from "date-fns";
import { fr } from 'date-fns/locale';
export default {
    props:['reunions'],
    data(){
        return {
            reunionEditing:null
        }
    },
    methods:{
        formattedDate(date) {
            return formatRelative(new Date(date), new Date(), { locale: fr });
        },
        getReunion(id){
            axios.get('/api/reunion/show-'+id)
            .then(response => this.reunionEditing = response.data)
            .catch(error => alert(error));
        },
        refresh(reunions){
            this.reunions = reunions;
        },
        deleteReunion(id){
            axios.delete('/api/reunion/'+id)
            .then(response => this.reunions = response.data)
            .catch(error => alert(error));
        }
    }
}
</script>
