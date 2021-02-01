<template>
    <div class="modal fade" id="editStaticData">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edition Donnée Statique</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" class="form-horizontal">
                <div class="card-body">
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Type</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" v-model="staticData.type" placeholder="Entrer le type">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Valeur</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" v-model="staticData.valeur"  placeholder="Entrer la valeur">
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fermer</button>
              <button type="button" class="btn btn-outline-success"  data-dismiss="modal" @click="editStaticData">Ajouter</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
</template>

<script>
export default {
    props:['staticData'],
    data(){
        return {

        }
    },
    methods:{
        editStaticData(){
            axios.patch('/api/staticdata/edit-'+this.staticData.id, {
                type: this.staticData.type,
                valeur: this.staticData.valeur
            })
            .then(response => this.$emit('sdUpdating', response.data))
            .catch(error => alert(error));
        }
    }
}
</script>
