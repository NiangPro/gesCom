import Dashboard from './components/DashboardComponent.vue';
import StaticData from './components/StaticDataComponent.vue';
import Employe from './components/EmployeComponent.vue';
import Client from './components/ClientComponent.vue';
import Fournisseur from './components/FournisseurComponent.vue';
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
            path: "*",
            component: NotFound
        }
    ]
}
