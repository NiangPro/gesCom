<template>
    <div class="modal fade" id="infoClient" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
            <!--Content-->
            <div class="modal-content">

            <!--Header-->
            <div class="modal-header">
                <img src="dist/img/user1-128x128.jpg" alt="" class="img-fluid rounded-circle user-avatar-xxl img-responsive">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
            </div>
            <!--Body-->
            <div class="modal-body text-center mb-1">

                <h5 class="mt-1 mb-2">{{ cli.prenom }}  {{cli.nom}}</h5>

                <table class="table table-striped table-responsive">
                    <tr>
                        <td>Email:</td>
                        <td>{{cli.email}}</td>
                    </tr>
                    <tr>
                        <td>Tel:</td>
                        <td>{{cli.tel}}</td>
                    </tr>
                    <tr>
                        <td>Pays:</td>
                        <td>{{cli.pays}}</td>
                    </tr>
                    <tr>
                        <td>Adresse:</td>
                        <td>{{cli.adresse}}</td>
                    </tr>
                </table>
            </div>

            </div>
            <!--/.Content-->
        </div>
    </div>

</template>

<script>
    export default{
        props:['cli']
    }
</script>
