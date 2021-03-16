<template>
    <div>
        <add-employed @employeAdded="refresh" @errorAdded="erreur"></add-employed>
        <entete :subTitle="subTitle" :title="title"></entete>

        <button type="button" class="btn btn-outline-success toastrDefaultInfo my-3" data-toggle="modal" data-target="#addEmployed">
                  Ajouter
        </button>

        <list-employed :emps="employeds"></list-employed>

    </div>
</template>

<script>
    export default {
        data(){
            return {
                title:'Employés',
                subTitle:'Employés',
                employeds:{}
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            getEmployeds(){
                axios.get('/api/employe')
                .then(response => this.employeds = response.data)
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
            refresh(employeds){
                this.employeds = employeds;
                this.showAlert('L\'employé a été ajouté', 'success');
            },
            erreur(){
                this.showAlert('Tous les champs (*) sont obligatoires', 'error');
            }
        },
        created(){
            this.getEmployeds();
        }
    }
</script>
