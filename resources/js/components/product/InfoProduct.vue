<template>
    <div class="modal fade" id="infoProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
            <!--Content-->
            <div class="modal-content">

            <!--Header-->
            <div class="modal-header">
                Information du Produit/Service
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
            </div>
            <!--Body-->
            <div class="modal-body text-center mb-1">
<table class="table table-striped table-responsive">
                    <tr>
                        <td>Nom:</td>
                        <td>{{prod.nom}}</td>
                    </tr>
                    <tr>
                        <td>Type:</td>
                        <td>{{prod.type}}</td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td>{{prod.description}}</td>
                    </tr>
                    <tr>
                        <td>Tarif:</td>
                        <td>{{prod.tarif}} F cfa</td>
                    </tr>
                    <tr>
                        <td>Taxe:</td>
                        <td>{{prod.taxe}} %</td>
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
        props:['prod']
    }
</script>
