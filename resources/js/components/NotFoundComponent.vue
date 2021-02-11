<template>
    <div class="absolute insert-0 bg-grey-200 items-center justify-center">
        <div class="display-4 text-center">
            Oups ! La page indiquée est introuvable <br>
            <router-link to="/" class="btn btn-outline-info">Accueil</router-link>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
