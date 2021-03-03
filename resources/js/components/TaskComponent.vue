<template>
    <div>
        <add-task v-on:taskAdded="refresh"></add-task>
        <button type="button" class="btn btn-outline-success toastrDefaultInfo my-3" data-toggle="modal" data-target="#addTask">
                  Ajouter
        </button>

        <list-task :tasks="tasks" ></list-task>
    </div>
</template>

<script>
    export default{
        data(){
            return {
                tasks:null
            }
        },
        methods:{
            getTasks(){
                axios.get('/api/task')
                .then(response => this.tasks = response.data)
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
            refresh(tasks){
                this.tasks = tasks;
                this.showAlert('La tâche a été ajoutée');
            }
        },
        created(){
            this.getTasks();
        }
    }
</script>
