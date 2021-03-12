<template>
    <div>
        <add-prospect @prospectAdded="refresh" @errorAdded="erreur"></add-prospect>
        <entete :subTitle="subTitle" :title="title"></entete>

        <button type="button" class="btn btn-outline-success toastrDefaultInfo my-3" data-toggle="modal" data-target="#addProspect">
                  Ajouter
        </button>

        <list-prospect :prospects="prospects"></list-prospect>
    </div>
</template>

<script>
export default {
    data(){
        return {
            title:'Prospects',
            subTitle:'/Prospects',
            prospects:null
        }
    },
    methods:{
        erreur(){
            this.showAlert('Tous les champs (*) sont obligatoires', 'error');
        },
        getProspect(){
            axios.get('/api/prospect')
            .then(response => this.prospects = response.data)
            .catch(error => alert(error));
        },
        refresh(prospects){
            this.prospects = prospects;
            this.showAlert('Le prospect a été ajouté', 'success');
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
            }
    },
    created(){
        this.getProspect();
    }
}
</script>
