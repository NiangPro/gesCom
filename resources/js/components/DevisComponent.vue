<template>
    <div>
        <add-devis v-if="etat"  @backEtat="changeEtat" @devisAdded="refresh"></add-devis>
        <button  type="button" v-if="!etat"  @click="changeEtat"  class="btn btn-outline-success toastrDefaultInfo my-3">
                  Ajouter
        </button>

        <list-devis v-if="!etat" :devis="devis"></list-devis>
    </div>
</template>

<script>
export default {
    data(){
        return {
            etat : false,
            devis:null
        }
    },
    methods:{
        changeEtat(){
            this.etat = !this.etat;

        },
        getDevis(){
            axios.get('/api/devis')
            .then(response => this.devis = response.data)
            .catch(error => alert(error));
        },
        refresh(devis){
            this.devis = devis;
            this.changeEtat();
            this.showAlert('Le devis a été ajouté avec succès');
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
        }
    },
    created(){
        this.getDevis();
    }
}
</script>
