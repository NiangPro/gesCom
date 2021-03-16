<template>
    <div class="modal fade" id="infoUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog">
          <div class="modal-content ">
            <div class="modal-header">
                <img class="img-circle avatar-xs" :src="`/storage/images/`+user.avatar" alt="User Avatar">
              <h4 class="modal-title">{{user.name}}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="col text-center">
                            Rôle :
                        </div>
                        <div class="col h6">
                            {{user.role}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            Email :
                        </div>
                        <div class="col h6">
                            {{user.email}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            Sexe :
                        </div>
                        <div class="col h6">
                            {{user.sexe}}
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
        props:['user']
    }
</script>
<style>
.avatar-xs{
    height:150px;
    width:150px;
}
</style>
