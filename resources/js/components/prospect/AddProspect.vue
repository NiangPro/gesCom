<template>
    <div class="modal fade" id="addProspect">
        <div class="modal-dialog">
          <div class="modal-content ">
            <div class="modal-header">
              <h4 class="modal-title">Ajout Prospect</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <form>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="sujet">Sujet<span class="text-danger">*</span></label>
                        <textarea name="sujet"  class="form-control" v-model="form.sujet"></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="email">Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" placeholder="Entrer l'adresse email" v-model="form.email">
                        </div>
                        <div class="form-group col-md-6">
                        <label for="tel">Telephone<span class="text-danger">*</span></label>
                        <input type="tel" class="form-control"  placeholder="Entrer le numéro de telephone" v-model="form.tel">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fonction">Pays<span class="text-danger">*</span></label>
                        <select  class="form-control" v-model="form.pays">
                            <option v-for="p in pays" :key="p.id" v-bind:value="p.nom_fr">{{p.nom_fr}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Entrer l'adresse" v-model="form.adresse">
                    </div>
                    <div class="form-group">
                        <label for="fonction">Source<span class="text-danger">*</span></label>
                        <select  class="form-control" v-model="form.source">
                            <option v-for="s in sources" :key="s.id" v-bind:value="s.valeur">{{s.valeur}}</option>
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
              <button type="button" class="btn btn-outline-success" data-dismiss="modal" @click="addProspect()">Ajouter</button>
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
                email:'',
                tel:'',
                source:'',
                assignation:'',
                pays:'',
                sujet:'',
                adresse:''
            },
            pays:{},
            sources:{},
            emps:{}
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
        notEmpty(){
            if(this.form.assignation === '' || this.form.pays === '' || this.form.tel === '' || this.form.email === '' || this.form.adresse === '' || this.form.source === '' || this.form.sujet === ''){
                return false;
            }

            return true;
        },
        addProspect(){
            if(this.notEmpty()){
                axios.post('/api/prospect', this.form)
                .then(response => this.$emit('prospectAdded', response.data))
                .catch(error => alert(error));
            }else{
                this.$emit('errorAdded');
            }
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
