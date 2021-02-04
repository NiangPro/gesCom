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
        refresh(){
            axios.get('/api/expense')
            .then(response => this.expenses = response.data)
            .catch(error => alert(error));
        }
    },
    created(){
        this.refresh();
    }
}
</script>
