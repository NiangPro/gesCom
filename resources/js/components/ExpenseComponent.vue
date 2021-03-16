<template>
    <div>
        <entete :subTitle="subTitle" :title="title"></entete>

        <list-expense></list-expense>
    </div>
</template>

<script>
export default {
    data(){
        return {
            title:'Dépenses',
            subTitle:'Dépenses'
    }
}
}
</script>
