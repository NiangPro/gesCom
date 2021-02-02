<template>
    <div>
        <button type="button" class="btn btn-info toastrDefaultInfo my-3" data-toggle="modal" data-target="#addProduct">
                  Ajouter
        </button>

        <add-product v-on:productAdded="getProducts"></add-product>
        <list-product :products="products"></list-product>
    </div>
</template>

<script>
    export default{
        data(){
            return {
                products:null
            }
        },
        methods:{
            getProducts(){
                axios.get('/api/product')
                .then(response => this.products = response.data)
                .catch(error => alert(error));
            }
        },
        created(){
            this.getProducts();
        }
    }
</script>
