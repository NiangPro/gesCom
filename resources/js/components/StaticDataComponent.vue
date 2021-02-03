<template>
    <div>
        <add-staticdata v-on:staticDataAdded="getList"></add-staticdata>
        <button type="button" class="btn btn-info toastrDefaultInfo my-3" data-toggle="modal" data-target="#addStaticData">
                  Ajouter
        </button>


        <div class="row">
          <div class="col-md-12">
               <div class="accordion" id="accordionExample">
                    <list-staticdata :staticDatas="staticDatas"></list-staticdata>
                </div>
          </div>

        </div>
    </div>
</template>

<script>
    export default {

        data(){
            return {
                staticDatas: {}
            }
        },

        created(){
            this.getList();
        },

        methods:{
            getList(){
                axios.get('/api/staticdata')
                .then(response => this.staticDatas = response.data)
                .catch(error => alert(error));
            }

        }

    }
</script>

<style>

</style>
