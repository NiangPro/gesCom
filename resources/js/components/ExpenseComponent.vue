<template>
    <div>
        <add-expense @expenseAdded="refresh" @errorAdded="erreur"></add-expense>
        <entete :subTitle="subTitle" :title="title"></entete>

        <button type="button" class="btn btn-outline-success toastrDefaultInfo my-3" data-toggle="modal" data-target="#addExpense">
                  Ajouter
        </button>

        <list-expense :expenses="expenses"></list-expense>
    </div>
</template>

<script>
export default {
    data(){
        return {
            title:'Dépenses',
            subTitle:'/Dépenses',
            expenses:null
        }
    },
    methods:{
        erreur(){
            this.showAlert('Tous les champs (*) sont obligatoires', 'error');
        },
        getExpenses(){
            axios.get('/api/expense')
            .then(response => this.expenses = response.data)
            .catch(error => alert(error));
        },
            showAlert(message, type) {
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
        refresh(expenses){
            this.expenses = expenses;
            this.showAlert('La dépense a été ajouté', 'success');
        }
    },
    created(){
        this.getExpenses();
    }
}
</script>
