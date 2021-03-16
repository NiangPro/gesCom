<template>
 <div>
     <add-expense @expenseAdded="addExpense" @errorAdded="erreur"></add-expense>

        <button type="button" class="btn btn-outline-success toastrDefaultInfo my-3" data-toggle="modal" data-target="#addExpense">
                  Ajouter
        </button>
    <div class="row">
            <edit-expense v-on:expenseUpdated="refresh" :form="expenseEditing"></edit-expense>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card" id="tabcli">
                    <div class="card-header">
                        <h5 class="mb-0">Liste des dépenses </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Catégorie</th>
                                        <th>Mode de paiement</th>
                                        <th>Date</th>
                                        <th>Montant</th>
                                        <th>Description</th>
                                        <th>Reférence</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="exp in expenses.data" :key="exp.id">
                                            <td>{{exp.category}}</td>
                                            <td>{{exp.payment_mode}}</td>
                                            <td>{{formattedDate(exp.date)}}</td>
                                            <td>{{exp.montant}} F CFA</td>
                                            <td>{{exp.description}}</td>
                                            <td> {{exp.recu}} </td>
                                        <td><button class="btn btn-outline-primary btn-sm rounded mr-2" data-toggle="modal" data-target="#editExpense" @click="getExpense(exp.id)"><i class="fa fa-edit" aria-hidden="true"></i></button><button v-if="user.role === 'Admin'" class="btn btn-outline-danger btn-sm rounded" @click="deleteExpense(exp.id)"><i class="fa fa-trash" aria-hidden="true"></i></button> </td>
                                        </tr>
                                </tbody>
                            </table>
                            <pagination :data="expenses" @pagination-change-page="getResults" class="mt-3"></pagination>

                        </div>
                    </div>
                </div>
            </div>
        </div>
 </div>
</template>

<script>
import { format} from "date-fns";

export default {
    data(){
        return {
            expenseEditing:{},
            user:{},
            expenses:null
        }
    },
    methods:{
        formattedDate(date) {
            return format(new Date(date), 'dd/MM/yyyy')
        },
        getUser(){
            axios.get('/api/userConnected')
            .then(response => this.user = response.data)
            .catch(error => alert(error));
        },
        getExpense(id){
            axios.get('/api/expense/show-'+id)
            .then(response => this.expenseEditing = response.data)
            .catch(error => alert(error));
        },
        refresh(expenses){
            this.expenses = expenses;
            this.showAlert('La dépense a été mise à jour');
        },
        deleteExpense(id){
            if(confirm('Êtes-vous sûr de vouloir supprimer ?')){
                axios.delete('/api/expense/'+id)
                .then(response => {this.expenses = response.data, this.showAlert('La dépense a été supprimée')})
                .catch(error => alert(error));
            }else{
                this.showAlert('L\'opération a été annulée');
            }
        },
        showAlert(message, type='success') {
        // Use sweetalert2
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                })

                Toast.fire({
                icon: type,
                title: message
                })
        },
        getResults(page=1){
            axios.get('/api/expense?page='+page)
            .then(response => this.expenses = response.data)
            .catch(error => alert(error));
        },
        erreur(){
            this.showAlert('Tous les champs (*) sont obligatoires', 'error');
        },
        addExpense(expenses){
            this.expenses = expenses;
            this.showAlert('La dépense a été ajouté', 'success');
        }
    },
    mounted(){
        this.getUser();
        this.getResults();
    }
}
</script>
