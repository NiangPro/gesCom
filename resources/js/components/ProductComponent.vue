<template>
    <div>
        <button type="button" class="btn btn-outline-success toastrDefaultInfo my-3" data-toggle="modal" data-target="#addProduct">
                  Ajouter
        </button>

        <add-product v-on:productAdded="refresh"></add-product>
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
            refresh(products){
                this.products = products;
                this.showAlert('Le produit a été ajouté');
            }
        },
        created(){
            this.getProducts();
        }
    }
</script>
