<template>
  <div class="card bg-default p-2">
   <div class="row mb-2">
          <div class="col-lg-6">
            <h1 class="m-0 text-bold pl-2">{{title}}</h1>
          </div><!-- /.col -->
          <div class="col-lg-6 pt-3 text-right">
              <h5 class="text-bold text-decoration-none"><router-link to="/home"><i class="fa fa-home"></i>Accueil <i class="fa fa-angle-double-right" v-if="subTitle !== ''" aria-hidden="true"></i> </router-link>{{subTitle}}</h5>
          </div><!-- /.col -->
    </div><!-- /.row -->
    </div>
</template>

<script>
export default {
    props:['title', 'subTitle']
}
</script>

<style>

</style>
