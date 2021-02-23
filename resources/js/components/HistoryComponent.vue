<template>
   <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card" >
                    <div class="card-header">
                        <h5 class="mb-0">Liste des historiques </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example2" class="table table-striped table-bordered display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Type</th>
                                        <th>Utilisateur</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="h in histories" :key="h.id">
                                            <td>{{h.date}}</td>
                                            <td>{{h.description}}</td>
                                            <td>{{h.type}}</td>
                                            <td> {{h.user.name}} </td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
export default {
    data(){
        return {
            histories:null,
        }
    },
    methods:{
       getHistories(){
            axios.get('/api/history')
            .then(response => this.histories = response.data)
            .catch(error => alert(error));
        }
    },
    mounted(){
        this.getHistories();
        
    }
}

</script>

<style>

</style>
