<template>
    <div>
        <add-task @taskAdded="addTask" @errorAdded="erreur"></add-task>
        <button type="button" class="btn btn-outline-success toastrDefaultInfo my-3" data-toggle="modal" data-target="#addTask">
                  Ajouter
        </button>

    <div class="row">
            <edit-task v-on:taskUpdated="refresh" :form="taskEditing"></edit-task>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card" id="tabcli">
                    <div class="card-header">
                        <h5 class="mb-0">Liste des tâches </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Statut</th>
                                        <th>Type</th>
                                        <th>Description</th>
                                        <th>Date d'execution</th>
                                        <th>Assignation</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="task in tasks.data" :key="task.id">
                                            <td>{{task.titre}}</td>
                                            <td>{{task.statut}}</td>
                                            <td>{{task.type}}</td>
                                            <td>{{task.description}}</td>
                                            <td>{{formattedDate(task.execution)}}</td>
                                            <td>{{task.assignation}}</td>
                                        <td>
                                             <button class="btn btn-outline-primary btn-sm rounded mr-2" data-toggle="modal" data-target="#editTask" title="Editer" @click="getTask(task.id)"><i class="fa fa-edit" aria-hidden="true"></i></button><button class="btn btn-outline-danger btn-sm rounded" title="Supprimer" @click="deleteTask(task.id)"><i class="fa fa-trash" aria-hidden="true"></i></button> </td>
                                        </tr>
                                </tbody>
                            </table>
                            <pagination :data="tasks" @pagination-change-page="getResults" class="mt-3"></pagination>

                        </div>
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
   data(){
        return {
            taskEditing:null,
            tasks:null
        }
    },
    methods:{
        getResults(page=1){
                axios.get('/api/task?page='+page)
                .then(response => this.tasks = response.data)
                .catch(error => alert(error));
        },
        formattedDate(date) {
            return formatRelative(new Date(date), new Date(), { locale: fr });
        },
        getTask(id){
            axios.get('/api/task/show-'+id)
            .then(response => this.taskEditing = response.data)
            .catch(error => alert(error));
        },
        refresh(tasks){
           this.tasks = tasks;
           this.showAlert('Les informations de la tâche ont été modifiées');
        },
        deleteTask(id){
            if(confirm('Êtes-vous sûr de vouloir supprimer ?')){
                axios.delete('/api/task/'+id)
                .then(response => {this.tasks = response.data, this.showAlert('La tâche a été supprimée')})
                .catch(error => alert(error));
            }else{
                this.showAlert('L\'opération a été annulée');
            }
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
        addTask(tasks){
                this.tasks = tasks;
                this.showAlert('La tâche a été ajoutée', 'success');
            },
            erreur(){
                this.showAlert('Tous les champs (*) sont obligatoires', 'error');
            }
    },
    mounted(){
        this.getResults();
    }
}
</script>
