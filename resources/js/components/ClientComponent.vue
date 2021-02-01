<template>
    <div>
        <add-client v-on:clientAdded="refresh"></add-client>
        <button type="button" class="btn btn-info toastrDefaultInfo my-3" data-toggle="modal" data-target="#addClient">
                  Ajouter
        </button>

        <list-client :clients="clients"></list-client>
    </div>
</template>

<script>
export default {
    data(){
        return {
            clients:{}
        }
    },
    methods:{
        refresh(){
            axios.get('/api/client')
            .then(response => this.clients = response.data)
            .catch(error => alert(error));
        }
    },
    created(){
        this.refresh();
    }
}
</script>
