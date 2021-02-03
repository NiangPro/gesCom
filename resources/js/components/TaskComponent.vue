<template>
    <div>
        <add-task v-on:taskAdded="getTasks"></add-task>
        <button type="button" class="btn btn-info toastrDefaultInfo my-3" data-toggle="modal" data-target="#addTask">
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
            }
        },
        created(){
            this.getTasks();
        }
    }
</script>
