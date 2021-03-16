<template>
    <div>
        <entete :subTitle="subTitle" :title="title"></entete>

        <list-prospect></list-prospect>
    </div>
</template>

<script>
export default {
    data(){
        return {
            title:'Prospects',
            subTitle:'Prospects'
        }
    }
}
</script>
