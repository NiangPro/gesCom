<template>
    <div>
        <add-staticdata v-on:staticDataAdded="getList" :form="form"></add-staticdata>
        <!-- <button type="button" class="btn btn-success toastrDefaultInfo my-3" data-toggle="modal" data-target="#addStaticData" @click="newType">
                  Ajouter un nouveau type
        </button> -->

        <entete :subTitle="subTitle" :title="title"></entete>
        <div class="row">
          <div class="col-md-12">
               <div class="accordion" id="accordionExample">
                    <list-staticdata :staticDatas="staticDatas" @addNew="hasType"></list-staticdata>
                </div>
          </div>

        </div>
    </div>
</template>

<script>
    export default {

        data(){
            return {
                title:'Données Statiques',
                subTitle:'Données statiques',
                staticDatas: {},
                typeData:null,
                form:{
                    type:'',
                    valeur:'',
                    etat:false
                }
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
            },
            hasType(type){
                this.form.type = type;
                this.form.etat = true;
            },
            newType(){
                this.form.type = '';
                this.form.etat = false;
            }

        }

    }
</script>

<style>

</style>
