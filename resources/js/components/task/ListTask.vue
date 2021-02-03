<template>
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
                                    <tr v-for="task in tasks" :key="task.id">
                                            <td>{{task.titre}}</td>
                                            <td>{{task.statut}}</td>
                                            <td>{{task.type}}</td>
                                            <td>{{task.description}}</td>
                                            <td>{{task.execution}}</td>
                                            <td>{{task.assignation}}</td>
                                        <td>
                                             <button class="btn btn-warning rounded mr-2" data-toggle="modal" data-target="#editTask" @click="getTask(task.id)"><i class="fa fa-edit" aria-hidden="true"></i></button><button class="btn btn-danger rounded" @click="deleteTask(task.id)"><i class="fa fa-trash" aria-hidden="true"></i></button> </td>
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
    props:['tasks'],
    data(){
        return {
            taskEditing:{}
        }
    },
    methods:{
        getTask(id){
            axios.get('/api/task/show-'+id)
            .then(response => this.taskEditing = response.data)
            .catch(error => alert(error));
        },
        refresh(tasks){
           this.tasks = tasks;
        },
        deleteTask(id){
            axios.delete('/api/task/'+id)
            .then(response => this.tasks = response.data)
            .catch(error => alert(error));
        }
    }
}
</script>
