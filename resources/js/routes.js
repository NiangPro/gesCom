import Dashboard from './components/DashboardComponent.vue';
import StaticData from './components/StaticDataComponent.vue';
import Employe from './components/EmployeComponent.vue';
import Client from './components/ClientComponent.vue';
import Fournisseur from './components/FournisseurComponent.vue';
import Product from './components/ProductComponent.vue';
import Task from './components/TaskComponent.vue';
import Prospect from './components/ProspectComponent.vue';
import Expense from './components/ExpenseComponent.vue';
import Reunion from './components/ReunionComponent.vue';
import Vente from './components/VenteComponent.vue';
import Setting from './components/SettingComponent.vue';
import History from './components/HistoryComponent.vue';
import Devis from './components/DevisComponent.vue';
import Rapport from './components/RapportComponent.vue';
import NotFound from './components/NotFoundComponent.vue';

export default {
    mode: 'history',
    linkActiveClass: 'active',
    routes: [
        {
            path: "/home",
            component: Dashboard,
            name: "Home",
            // beforeEnter: (to, from, next) => {
            //     axios.get('/api/authentificated')
            //         .then(()=>{next()})
            //         .catch(()=>{return next({name:'login'})});
            // }
        },
        {
            path: "/staticdata",
            component: StaticData
        },
        {
            path: "/employe",
            component: Employe
        },
        {
            path: "/client",
            component: Client
        },
        {
            path: "/fournisseur",
            component: Fournisseur
        },
        {
            path: "/product",
            component: Product
        },
        {
            path: "/task",
            component: Task
        },
        {
            path: "/prospect",
            component: Prospect
        },
        {
            path: "/expense",
            component: Expense
        },
        {
            path: "/reunion",
            component: Reunion
        },
        {
            path: "/vente",
            component: Vente
        },
        {
            path: "/devis",
            component: Devis
        },
        {
            path: "/history",
            component: History,
            name: "history"
        },
        {
            path: "/rapport",
            component: Rapport,
            name: "rapport"
        },
        {
            path: "/setting",
            component: Setting,
            name: "setting"
        },
        {
            path: "*",
            component: NotFound
        }
    ]
}
