<template>
    <div class="modal fade" id="editProspect">
        <div class="modal-dialog">
          <div class="modal-content ">
            <div class="modal-header">
              <h4 class="modal-title">Edition Prospect</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <form>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="sujet">Sujet</label>
                        <textarea name="sujet"  class="form-control" v-model="form.sujet"></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" placeholder="Entrer l'adresse email" v-model="form.email">
                        </div>
                        <div class="form-group col-md-6">
                        <label for="tel">Telephone</label>
                        <input type="text" class="form-control"  placeholder="Entrer le numéro de telephone" v-model="form.tel">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fonction">Pays</label>
                        <select  class="form-control" v-model="form.pays">
                            <option v-for="p in pays" :key="p.id" v-bind:value="p.nom_fr">{{p.nom_fr}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <input type="text" class="form-control" placeholder="Entrer l'adresse" v-model="form.adresse">
                    </div>
                    <div class="form-group">
                        <label for="fonction">Source</label>
                        <select  class="form-control" v-model="form.source">
                            <option v-for="s in sources" :key="s.id" v-bind:value="s.valeur">{{s.valeur}}</option>
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
              <button type="button" class="btn btn-outline-info" data-dismiss="modal" @click="editProspect(form.id)">Modifier</button>
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
            pays:null,
            sources:null,
            emps:null
        }
    },
    methods:{
        getCountry(){
            axios.get('/api/pays')
            .then(response => this.pays = response.data)
            .catch(error => alert(error));
        },
        getProspectSource(){
            axios.get('/api/prospectSource')
            .then(response => this.sources = response.data)
            .catch(error => alert(error));
        },
        editProspect(id){
            axios.patch('/api/prospect/edit-'+id, this.form)
                .then(response => this.$emit('prospectUpdated', response.data))
                .catch(error => alert(error));
        },
        getEmployeds(){
            axios.get('/api/getEmployeds')
            .then(response => this.emps = response.data)
            .catch(error => alert(error));
        }
    },
    mounted(){
        this.getCountry();
        this.getProspectSource();
        this.getEmployeds();
    }
}
</script>
