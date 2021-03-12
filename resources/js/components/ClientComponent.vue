<template>
    <div>
        <add-client @clientAdded="refresh" @errorAdded="erreur"></add-client>
        <entete :subTitle="subTitle" :title="title"></entete>

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
            title:'Clients',
            subTitle:'/Clients',
            clients:{}
        }
    },
    methods:{
        erreur(){
            this.showAlert('Tous les champs (*) sont obligatoires', 'error');
        },
        refresh(clients){
            this.clients = clients;
            this.showAlert('Le client a été ajouté', 'success');
        },
        showAlert(message, type) {
        // Use sweetalert2
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                })

                Toast.fire({
                icon: type,
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
