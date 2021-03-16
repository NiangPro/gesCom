<template>
    <div class="modal fade" id="addTask">
        <div class="modal-dialog">
          <div class="modal-content ">
            <div class="modal-header">
              <h4 class="modal-title">Ajout Tâche</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <form>
            <div class="modal-body">
                    <div class="form-group ">
                        <label for="nom">Titre<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Entrer le nom" v-model="form.titre">
                    </div>
                    <div class="form-group">
                        <label for="fonction">Statut<span class="text-danger">*</span></label>
                        <select  class="form-control" v-model="form.statut">
                            <option v-for="ts in taskStatus" :key="ts.id" v-bind:value="ts.valeur">{{ts.valeur}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Description<span class="text-danger">*</span></label>
                        <textarea name="description"  class="form-control" v-model="form.description"></textarea>
                    </div>
                    <div class="form-group ">
                        <label for="execution">Date d'execution<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" placeholder="Entrer la date d'execution" v-model="form.execution">
                        </div>

                    <div class="form-group">
                        <label for="fonction">Type<span class="text-danger">*</span></label>
                        <select  class="form-control" v-model="form.type">
                            <option value="Dépense">Dépense</option>
                            <option value="Prospect">Prospect</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fonction">Assignation<span class="text-danger">*</span></label>
                        <select  class="form-control" v-model="form.assignation">
                            <option v-for="emp in emps" :key="emp.id" v-bind:value="emp.prenom + ` `+emp.nom">{{emp.prenom}} {{emp.nom}}</option>
                        </select>
                    </div>
                </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fermer</button>
              <button type="button" class="btn btn-outline-info" data-dismiss="modal" @click="addTask">Ajouter</button>
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
                titre:'',
                type:'',
                description:'',
                statut:'',
                assignation:'',
                execution:''
            },
            taskStatus:{},
            emps:{}
        }
    },
    methods:{
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
        addTask(){
            if(this.notEmpty()){
                axios.post('/api/task', this.form)
                .then(response => this.$emit('taskAdded', response.data))
                .catch(error => alert(error));
            }else{
                this.$emit('errorAdded');
            }
        },
        notEmpty(){
            if(this.form.titre === '' || this.form.type === '' || this.form.description === '' || this.form.statut === '' || this.form.assignation === '' || this.form.execution === ''){
                return false;
            }else{
                return true;
            }
        }

    },
    mounted(){
        this.getTaskStatus();
        this.getEmployeds();
    }
}
</script>

<style>

</style>
