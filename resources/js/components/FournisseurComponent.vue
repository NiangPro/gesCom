<template>
    <div>
        <entete :subTitle="subTitle" :title="title"></entete>

        <list-fournisseur></list-fournisseur>
    </div>
</template>

<script>
export default {
    data(){
        return {
            title:'Fournisseurs',
            subTitle:'Fournisseurs',
        }
    }
}
</script>
