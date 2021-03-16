<template>
     <div class="card">
         <add-todo @todoAdded="getResults"></add-todo>
         <edit-todo :form="todoEditing" @todoUpdated="refresh"></edit-todo>
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  Liste à faire
                </h3>
                <button type="button" class="btn btn-outline-success ml-3 btn-sm" data-toggle="modal" data-target="#addTodo"><i class="fas fa-plus"></i> Ajouter</button>

                <div class="card-tools">


                <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="widgets.html" data-source-selector="#card-refresh-content" data-load-on-init="false"><i class="fas fa-sync-alt"></i></button>
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>

                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul class="todo-list" data-widget="todo-list">
                  <li v-for="todo in todos.data" :key="todo.id">
                    <!-- drag handle -->
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <!-- checkbox -->
                    <div  class="icheck-primary d-inline ml-2">
                      <input v-if="todo.is_check == 1"  @change="isChecked(todo.id)" type="checkbox" :value="todo.is_check" :name="`todo`+todo.id" :id="`todoCheck`+todo.id" checked>
                      <input v-if="todo.is_check == 0"  @change="isChecked(todo.id, todo.is_check)" type="checkbox" :value="todo.is_check" :name="`todo`+todo.id" :id="`todoCheck`+todo.id">
                      <label :for="`todoCheck`+todo.id"></label>
                    </div>
                    <!-- todo text -->
                    <span class="text">{{todo.titre}}</span>
                    <!-- Emphasis label -->
                    <small class="badge badge-dark"><i class="far fa-clock"></i> {{formattedDate(todo.date)}}</small>
                    <!-- General tools such as edit or delete-->
                    <div class="tools">
                      <i class="fas fa-edit" style="color:orange" @click="getTodo(todo.id)" data-toggle="modal" data-target="#editTodo"></i>
                      <i class="fas fa-trash" @click="deleteTodo(todo.id)"></i>
                    </div>
                  </li>
                </ul>
                <pagination :data="todos" @pagination-change-page="getResults" class="mt-3"></pagination>
              </div>
              <!-- /.card-body -->

            </div>
</template>

<script>
import { formatRelative } from "date-fns";
import { fr } from 'date-fns/locale';


export default {
    data(){
        return {
            form:{
                is_check:false,
                id:null
                },
            todoEditing:null,
            todos:null
        }
    },
    methods:{
      formattedDate(date) {
            return formatRelative(new Date(date), new Date(), { locale: fr });
        },
        getResults(page=1) {
            axios
                .get("/api/todo?page="+page)
                .then(response => this.todos = response.data)
                .catch(error => alert(error))
        },
        isChecked(id, is_check){
            this.check(id, is_check);

            axios.post('/api/todoEtat', this.form)
            .then(response => {this.todos = response.data, this.showAlert('Le statut de la tâche modifié')})
            .catch(error => alert(error));
        },
        check(id, is_check){
            if(is_check == 0){
                this.form.is_check = 1;
            }else{
                this.form.is_check = 0;
            }
            this.form.id = id;
        },
        getTodo(id){
            axios.get('/api/todo/'+id)
            .then(response => this.todoEditing = response.data)
            .catch(error => alert(error));
        },
        refresh(todos){
            this.todos = todos;
            this.showAlert('La tâche a été mis à jour');
        },
        deleteTodo(id){
            if(confirm('Êtes-vous sûr de vouloir supprimer ?')){
            axios.delete('/api/todo/'+id)
            .then(response => {this.todos = response.data, this.showAlert('Tâche supprimé')})
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
        }
    },
    mounted(){
        this.getResults();
    }
}
</script>

<style>

</style>
