<template>
    <div>
        <add-reunion v-on:reunionAdded="refresh"></add-reunion>
        <button type="button" class="btn btn-info toastrDefaultInfo my-3" data-toggle="modal" data-target="#addReunion">
                  Ajouter
        </button>

        <list-reunion :reunions="reunions"></list-reunion>
    </div>
</template>

<script>
export default {
    data(){
        return {
            reunions:null
        }
    },
    methods:{
        refresh(){
            axios.get('/api/reunion')
            .then(response => this.reunions = response.data)
            .catch(error => alert(error));
        }
    },
    created(){
        this.refresh();
    }
}
</script>
