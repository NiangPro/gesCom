<template>
    <div>
        <add-fournisseur v-on:frAdded="refresh"></add-fournisseur>
        <button type="button" class="btn btn-outline-success toastrDefaultInfo my-3" data-toggle="modal" data-target="#addFr">
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
        getFr(){
            axios.get('/api/fournisseur')
            .then(response => this.frs = response.data)
            .catch(error => alert(error));
        },
        refresh(frs){
            this.frs = frs;
            this.showAlert('Le fournisseur a été ajouté');
        }
        ,
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
            }
    },
    created(){
        this.getFr();
    }
}
</script>
