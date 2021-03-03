<template>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
              <div class="card-header">
                <h5 class="mb-0">Liste des historiques </h5>
                    <div class="card-tools">


                        <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="widgets.html" data-source-selector="#card-refresh-content" data-load-on-init="false"><i class="fas fa-sync-alt"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>

                    </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Utilisateur</th>
                            <th>Type</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="h in histories" :key="h.id">
                            <td>{{formattedDate(h.date)}}</td>
                            <td>{{h.user.name}}</td>
                            <td>{{h.type}}</td>
                            <td>{{h.description}}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Date</th>
                            <th>Utilisateur</th>
                            <th>Type</th>
                            <th>Description</th>
                        </tr>
                    </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
    </div>
</template>

<script>
import { formatRelative } from "date-fns";
import { fr } from 'date-fns/locale';

export default {
    data(){
        return {
            histories:null,
        }
    },
    methods:{
         formattedDate(date) {
            return formatRelative(new Date(date), new Date(), { locale: fr });
        },
       getHistories(){
            axios.get('/api/history')
            .then(response => this.histories = response.data)
            .catch(error => alert(error));
        }
    },
    mounted(){
        this.getHistories();

    }
}

</script>

<style>

</style>
