<template>
    <div>
        <add-reunion @reunionAdded="refresh" @errorAdded="erreur"></add-reunion>
        <entete :subTitle="subTitle" :title="title"></entete>

        <button type="button" class="btn btn-outline-success toastrDefaultInfo my-3" data-toggle="modal" data-target="#addReunion">
                  Ajouter un Rendez-vous
        </button>

        <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
              <div class="card-header">
                <button class="btn btn-outline-dark" @click="getTab">Tableau</button>
                <button class="btn btn-outline-primary" @click="getCal">Calendrier</button>
                    <div class="card-tools">


                        <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source-selector="#card-refresh-content" data-load-on-init="false"><i class="fas fa-sync-alt"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>

                    </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <list-reunion v-if="!getType" :reunions="reunions"></list-reunion>
                <fullcalendar-component v-if="getType" ></fullcalendar-component>
                <!-- <full-calendar v-if="getType" :event-sources="eventSources"></full-calendar> -->
              </div>
              <!-- /.card-body -->
            </div>
            </div>
    </div>


    </div>
</template>

<script>
export default {
    data(){
        return {
            title:'Réunions',
            subTitle:'Réunions',
            reunions:[],
            getType:false,

        }
    },
    methods:{
        getReunions(){
            axios.get('/api/reunion')
            .then(response => this.reunions = response.data)
            .catch(error => alert(error));
        },
        getCal(){
            this.getType = true;
        },
        getTab(){
            this.getType = false;
        },
        showAlert(message, type) {
        // Use sweetalert2
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                })

                Toast.fire({
                icon: type,
                title: message
                })
            },
            refresh(reunions){
                this.reunions = reunions;
                this.showAlert('La réunion a été ajouté', 'success');
            },
            erreur(){
                this.showAlert('Tous les champs (*) sont obligatoires', 'error');
            }
    },
    created(){
        this.getReunions();
    }
}
</script>
