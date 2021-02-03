<template>
     <div class="modal fade" id="addStaticData">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ajout Donnée Statique</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" class="form-horizontal">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="type" class="col-sm-2 col-form-label">Type</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="type" v-model="form.type" placeholder="Entrer le type">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="valeur" class="col-sm-2 col-form-label">Valeur</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" v-model="form.valeur" id="valeur" placeholder="Entrer la valeur">
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fermer</button>
              <button type="button" class="btn btn-outline-success"  data-dismiss="modal" @click="storeStaticData()">Ajouter</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
</template>

<script>
    export default {
        data(){
            return {
                form:{
                    type: null,
                    valeur:null
                },
                erreurs:{}
            }
        },
        methods:{
            storeStaticData(){
                axios.post('/api/staticdata', {
                    type: this.form.type,
                    valeur: this.form.valeur,
                    label: this.form.type,
                    statut: 0
                })
                .then(response => this.$emit('staticDataAdded', response.data))
                .catch(error => this.erreurs = error.data.errors);
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
