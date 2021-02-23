<template>
    <div>
        <add-employed @employeAdded="refresh"></add-employed>
        <button type="button" class="btn btn-success toastrDefaultInfo my-3" data-toggle="modal" data-target="#addEmployed">
                  Ajouter
        </button>

        <list-employed :emps="employeds"></list-employed>

    </div>
</template>

<script>
    export default {
        data(){
            return {
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
                icon: 'success',
                title: message
            })
            },
            refresh(employeds){
                this.employeds = employeds;
                this.showAlert('L\'employé a été ajouté');
            }
        },
        created(){
            this.getEmployeds();
        }
    }
</script>
