<template>
    <div>
        <add-fournisseur @frAdded="refresh" @errorAdded="erreur"></add-fournisseur>
        <entete :subTitle="subTitle" :title="title"></entete>

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
            title:'Fournisseurs',
            subTitle:'/Fournisseurs',
            frs:{}
        }
    },
    methods:{
        erreur(){
            this.showAlert('Tous les champs (*) sont obligatoires', 'error');
        },
        getFr(){
            axios.get('/api/fournisseur')
            .then(response => this.frs = response.data)
            .catch(error => alert(error));
        },
        refresh(frs){
            this.frs = frs;
            this.showAlert('Le fournisseur a été ajouté', 'success');
        }
        ,
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
            }
    },
    created(){
        this.getFr();
    }
}
</script>
