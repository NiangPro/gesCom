<template>
    <div>
        <add-expense v-on:expenseAdded="refresh"></add-expense>
        <button type="button" class="btn btn-info toastrDefaultInfo my-3" data-toggle="modal" data-target="#addExpense">
                  Ajouter
        </button>

        <list-expense :expenses="expenses"></list-expense>
    </div>
</template>

<script>
export default {
    data(){
        return {
            expenses:null
        }
    },
    methods:{
        getExpenses(){
            axios.get('/api/expense')
            .then(response => this.expenses = response.data)
            .catch(error => alert(error));
        },
            showAlert(message) {
        // Use sweetalert2
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                })

                Toast.fire({
                icon: 'success',
                title: message
                })
        },
        refresh(expenses){
            this.expenses = expenses;
            this.showAlert('La dépense a été ajouté');
        }
    },
    created(){
        this.getExpenses();
    }
}
</script>
