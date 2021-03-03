<template>
    <div class="modal fade" id="addReunion">
        <div class="modal-dialog">
          <div class="modal-content ">
            <div class="modal-header">
              <h4 class="modal-title">Ajout Réunion</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <form >
            <div class="modal-body">

                    <div class="form-group">
                        <label >Titre</label>
                        <input type="text" class="form-control" placeholder="Entrer le titre" v-model="form.title">
                    </div>


                    <div class="form-group">
                        <label for="adresse">Date</label>
                        <input type="datetime-local" class="form-control" placeholder="Entrer la date" v-model="form.date">
                    </div>

                    <div class="form-group">
                        <label for="adresse">Description</label>
                        <textarea name="description"  class="form-control" v-model="form.description"></textarea>
                    </div>


                </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fermer</button>
              <button type="button" class="btn btn-outline-info" data-dismiss="modal" @click="addReunion()">Ajouter</button>
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
    data(){
        return {
            form:{
                title:null,
                description:null,
                date:null
            }
        }
    },
    methods:{
        addReunion(){
            axios.post('/api/reunion', this.form)
                .then(response => {this.$emit('reunionAdded', response.data), this.initForm()})
                .catch(error => alert(error));
        },
        initForm(){
            this.form.title = null;
                this.form.description = null;
                this.form.date = null;
                }
    },
    mounted(){
    }
}
</script>
