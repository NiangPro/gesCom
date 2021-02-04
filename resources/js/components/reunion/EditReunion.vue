<template>
    <div class="modal fade" id="editReunion">
        <div class="modal-dialog">
          <div class="modal-content ">
            <div class="modal-header">
              <h4 class="modal-title">Edition Réunion</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <form>
            <div class="modal-body">
                   <div class="form-group col-md-6">
                        <label >Titre</label>
                        <input type="text" class="form-control" placeholder="Entrer le titre" v-model="form.titre">
                    </div>

                    <div class="form-group">
                        <label for="adresse">Date</label>
                        <input type="date" class="form-control" placeholder="Entrer la date" v-model="form.date">
                    </div>

                    <div class="form-group">
                        <label for="adresse">Description</label>
                        <textarea name="description"  class="form-control" v-model="form.description"></textarea>
                    </div>
                </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fermer</button>
              <button type="button" class="btn btn-outline-info" data-dismiss="modal" @click="editReunion(form.id)">Modifier</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
</template>

<script>
export default {
    props:['form'],
    data(){
        return {

        }
    },
    methods:{
        editReunion(id){
            axios.patch('/api/reunion/edit-'+id, this.form)
                .then(response => this.$emit('reunionUpdated', response.data))
                .catch(error => alert(error));
        }
    },
    mounted(){
    }
}
</script>
