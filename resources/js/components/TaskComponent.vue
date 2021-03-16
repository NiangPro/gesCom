<template>
    <div>
        <entete :subTitle="subTitle" :title="title"></entete>
        <list-task></list-task>
    </div>
</template>

<script>
    export default{
        data(){
            return {
                title:'Tâches',
                subTitle:'Tâches'
            }
        },
        methods:{

        }
    }
</script>
