<template>
    <div class="modal fade" id="editTask">
        <div class="modal-dialog">
          <div class="modal-content ">
            <div class="modal-header">
              <h4 class="modal-title">Edition Tâche</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <form>
            <div class="modal-body">
                    <div class="form-group ">
                        <label for="nom">Titre</label>
                        <input type="text" class="form-control" placeholder="Entrer le nom" v-model="form.titre">
                    </div>
                    <div class="form-group">
                        <label for="fonction">Statut</label>
                        <select  class="form-control" v-model="form.statut">
                            <option v-for="ts in taskStatus" :key="ts.id" v-bind:value="ts.valeur">{{ts.valeur}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Description</label>
                        <textarea name="description"  class="form-control" v-model="form.description"></textarea>
                    </div>
                    <div class="form-group ">
                        <label for="execution">Date d'execution</label>
                        <input type="date" class="form-control" placeholder="Entrer la date d'execution" v-model="form.execution">
                        </div>

                    <div class="form-group">
                        <label for="fonction">Type</label>
                        <select  class="form-control" v-model="form.type">
                            <option v-for="t in taskType" :key="t.id" v-bind:value="t.valeur">{{t.valeur}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fonction">Assignation</label>
                        <select  class="form-control" v-model="form.assignation">
                            <option v-for="emp in emps" :key="emp.id" v-bind:value="emp.prenom + ` `+emp.nom">{{emp.prenom}} {{emp.nom}}</option>
                        </select>
                    </div>
                </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fermer</button>
              <button type="button" class="btn btn-outline-info" data-dismiss="modal" @click="editTask(form.id)">Modifier</button>
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
            taskType:null,
            taskStatus:null,
            emps:null
        }
    },
    methods:{
        getTaskType(){
            axios.get('/api/taskType')
            .then(response => this.taskType = response.data)
            .catch(error => alert(error));
        },
        getTaskStatus(){
            axios.get('/api/taskStatus')
            .then(response => this.taskStatus = response.data)
            .catch(error => alert(error));
        },
        getEmployeds(){
            axios.get('/api/getEmployeds')
            .then(response => this.emps = response.data)
            .catch(error => alert(error));
        },
        editTask(id){
            axios.patch('/api/task/edit-'+id, this.form)
            .then(response => this.$emit('taskUpdated', response.data))
            .catch(error => alert(error));
        }

    },
    mounted(){
        this.getTaskType();
        this.getTaskStatus();
        this.getEmployeds();
    }
}
</script>

<style>

</style>
