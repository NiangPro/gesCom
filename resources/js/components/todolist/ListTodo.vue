<template>
     <div class="card">
         <edit-todo :form="todoEditing" @todoUpdated="refresh"></edit-todo>
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  Liste à faire
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#addTodo"><i class="fas fa-plus"></i> Ajouter</button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul class="todo-list" data-widget="todo-list">
                  <li v-for="todo in todos" :key="todo.id">
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
                    <small class="badge badge-info"><i class="far fa-clock"></i> {{todo.date}}</small>
                    <!-- General tools such as edit or delete-->
                    <div class="tools">
                      <i class="fas fa-edit" style="color:orange" @click="getTodo(todo.id)" data-toggle="modal" data-target="#editTodo"></i>
                      <i class="fas fa-trash" @click="deleteTodo(todo.id)"></i>
                    </div>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->

            </div>
</template>

<script>
export default {
    props:['todos'],
    data(){
        return {
            form:{
                is_check:false,
                id:null
                },
            todoEditing:null
        }
    },
    methods:{
        isChecked(id, is_check){
            this.check(id, is_check);

            axios.post('/api/todoEtat', this.form)
            .then(response => this.todos = response.data)
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
        },
        deleteTodo(id){
            confirm('Êtes-vous de vouloir supprimer');
            axios.delete('/api/todo/'+id)
            .then(response => this.todos = response.data)
            .catch(error => alert(error));
        }
    }
}
</script>

<style>

</style>
