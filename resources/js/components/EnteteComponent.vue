<template>
  <div class="content-header">
   <div class="row mb-2">
          <div class="col-lg-6">
            <h1 class="m-0 text-dark text-bold">{{title}}</h1>
          </div><!-- /.col -->
          <div class="col-lg-6 text-right">
              <h5 class="text-bold text-decoration-none"><router-link to="/home"><i class="fa fa-home"></i>Accueil</router-link>{{subTitle}}</h5>
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
