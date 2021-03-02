<template>
    <div class="modal fade" id="infoEmployed" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog">
          <div class="modal-content ">
            <div class="modal-header">
                <img class="img-circle avatar-xs" :src="`/storage/images/`+empInfo.profil" alt="User Avatar">
              <h4 class="modal-title">{{empInfo.prenom}} {{empInfo.nom}}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="col text-center">
                            Fonction :
                        </div>
                        <div class="col h6">
                            {{empInfo.fonction}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            Email :
                        </div>
                        <div class="col h6">
                            {{empInfo.email}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            Tel :
                        </div>
                        <div class="col h6">
                            {{empInfo.tel}}
                        </div>
                    </div>
                     <div class="row">
                        <div class="col text-center">
                            Adresse :
                        </div>
                        <div class="col h6">
                            {{empInfo.adresse}}
                        </div>
                    </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
    </div>

</template>

<script>
    export default{
        props:['empInfo']
    }
</script>
<style>
.avatar-xs{
    height:150px;
    width:150px;
}
</style>
