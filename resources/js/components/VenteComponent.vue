<template>
    <div>
        <add-vente v-if="sale" @backSale="changeSale"></add-vente>
        <button v-if="!sale" type="button" @click="changeSale" class="btn btn-info toastrDefaultInfo my-3">
                  Ajouter
        </button>

        <list-vente  v-if="!sale"></list-vente>
    </div>
</template>

<script>
export default {
    data(){
        return {
            sale : false
        }
    },
    methods:{
        changeSale(){
            this.sale = !this.sale;
        }
    }
}
</script>
