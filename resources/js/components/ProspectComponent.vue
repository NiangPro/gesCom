<template>
    <div>
        <add-prospect v-on:prospectAdded="refresh"></add-prospect>
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
            prospects:null
        }
    },
    methods:{
        getProspect(){
            axios.get('/api/prospect')
            .then(response => this.prospects = response.data)
            .catch(error => alert(error));
        },
        refresh(prospects){
            this.prospects = prospects;
            this.showAlert('Le prospect a été ajouté');
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
        this.getProspect();
    }
}
</script>
