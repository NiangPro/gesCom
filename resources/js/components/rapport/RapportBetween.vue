<template>
  
     <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Rapport des ventes et dépenses entre deux dates
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="widgets.html" data-source-selector="#card-refresh-content" data-load-on-init="false"><i class="fas fa-sync-alt"></i></button>
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
                                        <span class="input-group-text" id="basic-addon1">Date du [ jj/mm/aaaa ]</span>
                                    </div>
                                    <input type="date" class="form-control" v-model="dateFrom">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Au [ jj/mm/aaaa ]</span>
                                    </div>
                                    <input type="Date" class="form-control" v-model="dateTo">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-outline-success" @click="getSum">Valider</button>
                            </div>
                        </div>

                <rapport-result></rapport-result>           
              </div><!-- /.card-body -->
            </div>

    
</template>

<script>
export default {
    data(){
        return {
            dateFrom:null,
            dateTo:null
        }
    },
    methods:{
        getSum(){
            axios.get('/api/rapportBetween/'+this.dateFrom+'-'+this.dateTo)
            .then(response => console.log(response.data))
            .catch(error => alert(error));
        }
    }
}
</script>

<style>

</style>