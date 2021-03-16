<template>
    <div>
        <entete :subTitle="subTitle" :title="title"></entete>

        <list-product></list-product>
    </div>
</template>

<script>
    export default{
        data(){
            return {
                title:'Produits & Services',
                subTitle:'Produits-services',
            }
        },
        methods:{

        },
        created(){
            this.getProducts();
        }
    }
</script>
