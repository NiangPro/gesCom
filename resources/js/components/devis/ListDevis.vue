<template>
    <div>
        <info-devis
            v-if="info"
            @listDevis="getInfo"
            :devis="devisEditing"
        ></info-devis>
        <div class="row" v-if="!info">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Liste des Devis</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                id="example3"
                                class="table table-striped table-bordered"
                                style="width:100%"
                            >
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Client</th>
                                        <th>Employé</th>
                                        <th>Montant Total</th>
                                        <th>Produit/Service</th>
                                        <th>Statut</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="vente in devis" :key="vente.id">
                                        <td>
                                            {{formattedDate(vente.date)}}
                                        </td>
                                        <td>{{ vente.client.nom }}</td>
                                        <td>
                                            {{ vente.employed.prenom }}
                                            {{ vente.employed.nom }}
                                        </td>
                                        <td>{{ vente.total_amount }} F CFA</td>
                                        <td>
                                            <span
                                                v-for="product in devisItems"
                                                :key="product.id"
                                            >
                                                <span
                                                    v-if="
                                                        vente.id ==
                                                            product.devis_id
                                                    "
                                                    >{{ product.nom }}</span
                                                ><br />
                                            </span>
                                        </td>
                                        <td>{{ vente.statut }}</td>
                                        <td>
                                            <button
                                                class="btn btn-outline-primary rounded btn-sm"
                                            >
                                                <i
                                                    class="fa fa-eye"
                                                    aria-hidden="true"
                                                    @click="getDevis(vente.id)"
                                                ></i>
                                            </button>
                                            <button
                                                class="btn btn-outline-danger rounded btn-sm"
                                                @click="deleteDevis(vente.id)" v-if="user.role === 'Admin'"
                                            >
                                                <i
                                                    class="fa fa-trash"
                                                    aria-hidden="true"
                                                ></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
    props: ["devis"],
    data() {
        return {
            info: false,
            devisEditing: {},
            devisItems: {},
            user:{}
        };
    },
    methods: {
        formattedDate(date) {
            return format(new Date(date), 'MM/dd/yyyy')
        },
        getUser(){
            axios.get('/api/userConnected')
            .then(response => this.user = response.data)
            .catch(error => alert(error));
        },
        refresh(devis) {
            this.devis = devis;
            this.showAlert("Le devis a été modifié");
        },
        getDevis(id) {
            axios
                .get("/api/devis/show-" + id)
                .then(response => {
                    this.devisEditing = response.data, this.getInfo()
                })
                .catch(error => alert(error));
        },
        getInfo() {
            this.info = !this.info;
        },
        getDevisItems() {
            axios
                .get("/api/devisItems")
                .then(response => (this.devisItems = response.data))
                .catch(error => alert(error));
        },
        showAlert(message) {
            // Use sweetalert2
            const Toast = Swal.mixin({
                toast: true,
                position: "top",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });

            Toast.fire({
                icon: "success",
                title: message
            });
        },
        deleteDevis(id) {
            if(confirm('Êtes-vous sûr de vouloir supprimer ?')){
            axios.delete("/api/devis/" + id)
                .then(response => {
                    (this.devis = response.data),
                        this.showAlert("Le devis a été supprimé");
                })
                .catch(error => alert(error));
                }else{
                    this.showAlert('L\'opération a été annulée');
                }
        }
    },
    mounted(){
        this.getDevisItems();
        this.getUser();
    }
};
</script>
