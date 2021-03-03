<template>
    <div>
        <add-client v-on:clientAdded="refresh"></add-client>
        <button type="button" class="btn btn-outline-success toastrDefaultInfo my-3" data-toggle="modal" data-target="#addClient">
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
        refresh(clients){
            this.clients = clients;
            this.showAlert('Le client a été ajouté');
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
            getClients(){
                 axios.get('/api/client')
                .then(response => this.clients = response.data)
                .catch(error => alert(error));
            }
    },
    created(){
        this.getClients();
    }
}
</script>
