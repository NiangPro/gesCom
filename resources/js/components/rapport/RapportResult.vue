<template>
  <div>
      <h4 class="mt-3">Résultat de la recherche : Date du {{formattedDate(result.from)}} au {{formattedDate(result.to)}}</h4>
       <div class="row">
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h5>{{result.vente}} FCFA</h5>

                        <p>Ventes</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag" style="color:black"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h5>{{result.depense}} FCFA</h5>

                        <p>Depense</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-product-hunt" style="color:orange"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-black">
                    <div class="inner">
                        <h5>{{recette}} FCFA</h5>

                        <p>Recette</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-coins" style="color:cyan"></i>
                    </div>
                </div>
            </div>
        </div>
  </div>
</template>

<script>
import { format} from "date-fns";

export default {
    props:['result'],
    data(){
        return{
            recette: this.result.vente - this.result.depense
        }
    },
    methods:{
        formattedDate(date) {
            return format(new Date(date), 'dd/MM/yyyy')
        },
    }
}
</script>

<style>

</style>