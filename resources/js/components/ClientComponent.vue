<template>
    <div>
        <entete :subTitle="subTitle" :title="title"></entete>

        <list-client></list-client>
    </div>
</template>

<script>
export default {
    data(){
        return {
            title:'Clients',
            subTitle:'Clients',
        }
    },
    methods:{

    }
}
</script>
