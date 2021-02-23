<template>
<div class="modal fade" id="addTodo">
        <div class="modal-dialog">
          <div class="modal-content ">
            <div class="modal-header">
              <h4 class="modal-title">Ajout Tâche</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <form>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="tire">Titre</label>
                        <input type="text" class="form-control" placeholder="Entrer le tire" v-model="form.titre">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="date">Date</label>
                        <input type="datetime-local" class="form-control" v-model="form.date">
                    </div>

                </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fermer</button>
              <button type="button" class="btn btn-outline-info" data-dismiss="modal" @click="addTodo">Ajouter</button>
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
                titre:null,
                date:null
            }
        }
    },
    methods:{
        addTodo(){
            axios.post('/api/todo', this.form)
            .then(response => {this.$emit('todoAdded', response.data), this.showAlert('Tâche ajouté avec succès')})
            .catch(error => alert(error));
        },
        showAlert(message) {
        // Use sweetalert2
           const Toast = Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            })

            Toast.fire({
            icon: 'success',
            title: message
            })
        }
    }
}
</script>

<style>

</style>
