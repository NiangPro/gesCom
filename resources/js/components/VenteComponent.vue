<template>
    <div>
        <add-vente v-if="sale"  @backSale="changeSale" @saleAdded="refresh"></add-vente>
        <button  type="button" v-if="!sale"  @click="changeSale"  class="btn btn-info toastrDefaultInfo my-3">
                  Ajouter
        </button>

        <list-vente v-if="!sale" :ventes="ventes"></list-vente>
    </div>
</template>

<script>
export default {
    data(){
        return {
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
        }
    },
    created(){
        this.getVentes();
    }
}
</script>
