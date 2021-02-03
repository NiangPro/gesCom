<template>
    <div>
        <add-prospect v-on:prospectAdded="refresh"></add-prospect>
        <button type="button" class="btn btn-info toastrDefaultInfo my-3" data-toggle="modal" data-target="#addProspect">
                  Ajouter
        </button>

        <list-prospect :prospects="prospects"></list-prospect>
    </div>
</template>

<script>
export default {
    data(){
        return {
            prospects:null
        }
    },
    methods:{
        refresh(){
            axios.get('/api/prospect')
            .then(response => this.prospects = response.data)
            .catch(error => alert(error));
        }
    },
    created(){
        this.refresh();
    }
}
</script>
