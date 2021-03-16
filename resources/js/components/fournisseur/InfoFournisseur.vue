<template>
    <div class="modal fade" id="infoFr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog cascading-modal modal-sm" role="document">
            <!--Content-->
            <div class="modal-content">

            <!--Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
            </div>
            <!--Body-->
            <div class="modal-body text-center mb-1">

                <h5 class="mt-1 mb-2">{{ fr.prenom }}  {{fr.nom}}</h5>

                <table class="table table-striped table-responsive">
                    <tr>
                        <td>Email:</td>
                        <td>{{fr.email}}</td>
                    </tr>
                    <tr>
                        <td>Tel:</td>
                        <td>{{fr.tel}}</td>
                    </tr>
                    <tr>
                        <td>Pays:</td>
                        <td>{{fr.pays}}</td>
                    </tr>
                    <tr>
                        <td>Adresse:</td>
                        <td>{{fr.adresse}}</td>
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
        props:['fr']
    }
</script>
