<template>
    <div>
        <add-fournisseur v-on:frAdded="refresh"></add-fournisseur>
        <button type="button" class="btn btn-info toastrDefaultInfo my-3" data-toggle="modal" data-target="#addFr">
                  Ajouter
        </button>

        <list-fournisseur :frs="frs"></list-fournisseur>
    </div>
</template>

<script>
export default {
    data(){
        return {
            frs:{}
        }
    },
    methods:{
        refresh(){
            axios.get('/api/fournisseur')
            .then(response => this.frs = response.data)
            .catch(error => alert(error));
        }
    },
    created(){
        this.refresh();
    }
}
</script>
