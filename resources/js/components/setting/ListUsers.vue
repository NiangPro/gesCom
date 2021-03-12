<template>
  <div class="row">
      <div class="col-md-3" v-for="user in users" :key="user.id">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-info">
                    <h3 class="widget-user-username">{{user.name}}</h3>
                    <h6 class="widget-user-desc">{{user.role}}</h6>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle elevation-2" :src="`/storage/images/`+user.avatar" alt="User Avatar">
                </div>
                <div class="card-footer">
                    <div class="row">
                    <div class="col-sm-6 border-right">
                        <div class="description-block">
                            <span class="description-text">
                                <button class="btn btn-outline-success btn-rounded btn-sm" title="Consulter" data-toggle="modal" data-target="#infoEmployed"><i class="fa fa-eye" aria-hidden="true" ></i></button>
                            </span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <div class="col-sm-6">
                        <div class="description-block">
                        <span class="description-text">
                            <button class="btn btn-outline-danger btn-rounded btn-sm" title="Supprimer"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.widget-user -->
        </div>
  </div>
</template>

<script>
export default {
    props:['users']
}
</script>

<style>

</style>
