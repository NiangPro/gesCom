<template>
  <div class="card">
         <div class="card-header">
                <h3 class="card-title">
                  <i class="fa fa-history mr-1" aria-hidden="true"></i>
                  Dernières activités des utilisateurs
                </h3>

                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="widgets.html" data-source-selector="#card-refresh-content" data-load-on-init="false"><i class="fas fa-sync-alt"></i></button>
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>

                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul class="todo-list" data-widget="todo-list">
                  <li v-for="h in histories" :key="h.id">
                    <!-- drag handle -->
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <!-- checkbox -->

                    <!-- todo text -->
                    <span class="text">{{h.description}} par ({{h.user.name}})</span>
                    <!-- Emphasis label -->
                    <small class="badge badge-warning"><i class="far fa-clock"></i> {{formattedDate(h.date)}}</small>
                    <!-- General tools such as edit or delete-->

                  </li>
                </ul>
              </div>
              <!-- /.card-body -->

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
            axios.get('/api/lastHistories')
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
