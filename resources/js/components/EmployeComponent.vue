<template>
    <div>
        <add-employed v-on:employeAdded="getEmployeds"></add-employed>
        <button type="button" class="btn btn-info toastrDefaultInfo my-3" data-toggle="modal" data-target="#addEmployed">
                  Ajouter
        </button>

        <list-employed :emps="employeds"></list-employed>

    </div>
</template>

<script>
    export default {
        data(){
            return {
                employeds:{}
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            getEmployeds(){
                axios.get('/api/employe')
                .then(response => this.employeds = response.data)
                .catch(error => alert(error));
            }
        },
        created(){
            this.getEmployeds();
        }
    }
</script>
