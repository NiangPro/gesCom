<template>

     <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Rapport des ventes et dépenses entre deux dates
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="card-refresh"  @click="init" data-source-selector="#card-refresh-content" data-load-on-init="false"><i class="fas fa-sync-alt"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>

                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                  <!--  Ligne 1 -->
                        <div class="row">
                            <div class="col-md-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Date du <span class="text-danger">*</span></span>
                                    </div>
                                    <input type="date" class="form-control" v-model="form.dateFrom">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Au<span class="text-danger">*</span></span>
                                    </div>
                                    <input type="Date" class="form-control" v-model="form.dateTo">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-outline-success" @click="getResult">Valider</button>
                            </div>
                        </div>
                <rapport-result v-if="result" :result="donnees"></rapport-result>
              </div><!-- /.card-body -->
            </div>


</template>

<script>
export default {
    data(){
        return {
            form:{
                dateFrom:null,
                dateTo:null
            },
            result:false,
            donnees:null
        }
    },
    methods:{
        getResult(){
            if( this.form.dateFrom== null || this.form.dateTo == null){
                this.showAlert('Veuillez choisir les deux dates', 'error');
            }else if(this.form.dateFrom > this.form.dateTo){
                this.showAlert('La date de depart ne doit pas être supérieur à la date de fin', 'error');
            }else{
                axios.post('/api/rapportBetween', this.form)
                .then(response => {this.donnees = response.data, this.result = true})
                .catch(error => alert(error));
            }
        },
        init(){
            this.result = false;
            this.donnees = null;
            this.form.dateFrom = null;
            this.form.dateTo = null;
        },
        showAlert(message, type) {
        // Use sweetalert2
           const Toast = Swal.mixin({
            toast: true,
            position: 'top-center',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
            })

            Toast.fire({
            icon: type,
            title: message
            })
        }
    }
}
</script>

<style>

</style>
