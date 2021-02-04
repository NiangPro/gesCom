import Dashboard from './components/DashboardComponent.vue';
import StaticData from './components/StaticDataComponent.vue';
import Employe from './components/EmployeComponent.vue';
import Client from './components/ClientComponent.vue';
import Fournisseur from './components/FournisseurComponent.vue';
import Product from './components/ProductComponent.vue';
import Task from './components/TaskComponent.vue';
import Prospect from './components/ProspectComponent.vue';
import Expense from './components/ExpenseComponent.vue';
import NotFound from './components/NotFoundComponent.vue';

export default {
    mode: 'history',
    linkActiveClass: 'active',
    routes: [
        {
            path: "/",
            component: Dashboard
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
            path: "*",
            component: NotFound
        }
    ]
}
