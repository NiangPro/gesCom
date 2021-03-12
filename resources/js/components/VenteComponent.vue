<template>
    <div>
        <add-vente v-if="sale"  @backSale="changeSale" @saleAdded="refresh"></add-vente>
        <entete :subTitle="subTitle" :title="title"></entete>

        <button  type="button" v-if="!sale"  @click="changeSale"  class="btn btn-outline-success toastrDefaultInfo my-3">
                  Ajouter
        </button>

        <list-vente v-if="!sale" :ventes="ventes"></list-vente>
    </div>
</template>

<script>
export default {
    data(){
        return {
            title:'Ventes',
            subTitle:'/Ventes',
            sale : false,
            ventes:null
        }
    },
    methods:{
        changeSale(){
            this.sale = !this.sale;

        },
        getVentes(){
            axios.get('/api/vente')
            .then(response => this.ventes = response.data)
            .catch(error => alert(error));
        },
        refresh(sales){
            this.ventes = sales;
            this.changeSale();
            this.showAlert('La vente a été ajoutée avec succès');
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
        this.getVentes();
    }
}
</script>
