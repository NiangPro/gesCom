require('./bootstrap');

// import 'fullcalendar/dist/fullcalendar.css';


window.Vue = require('vue').default;

// import FullCalendar from 'vue-full-calendar'; //Import Full-calendar

// Vue.use(FullCalendar);


Vue.component('fullcalendar-component', require('./components/FullCalendarComponent.vue').default);


import VueSweetalert2 from 'vue-sweetalert2';



Vue.use(VueSweetalert2);

import VueRouter from 'vue-router';
import routes from './routes';

Vue.use(VueRouter);

import VueApexCharts from 'vue-apexcharts'
Vue.use(VueApexCharts)

Vue.component('apexchart', VueApexCharts)

Vue.component('entete', require('./components/EnteteComponent').default);
Vue.component('pagination', require('laravel-vue-pagination'));

Vue.component('add-staticdata', require('./components/staticData/AddStaticData').default);
Vue.component('list-staticdata', require('./components/staticData/ListStaticData').default);
Vue.component('edit-staticdata', require('./components/staticData/EditStaticData').default);

Vue.component('add-employed', require('./components/employe/AddEmploye').default);
Vue.component('list-employed', require('./components/employe/ListEmploye').default);
Vue.component('edit-employed', require('./components/employe/EditEmploye').default);
Vue.component('info-employed', require('./components/employe/InfoEmploye').default);
Vue.component('edit-profil', require('./components/employe/EditProfil').default);

Vue.component('add-client', require('./components/client/AddClient').default);
Vue.component('list-client', require('./components/client/ListClient').default);
Vue.component('info-client', require('./components/client/InfoClient').default);
Vue.component('edit-client', require('./components/client/EditClient').default);

Vue.component('add-fournisseur', require('./components/fournisseur/AddFournisseur').default);
Vue.component('list-fournisseur', require('./components/fournisseur/ListFournisseur').default);
Vue.component('info-fournisseur', require('./components/fournisseur/InfoFournisseur').default);
Vue.component('edit-fournisseur', require('./components/fournisseur/EditFournisseur').default);

Vue.component('add-product', require('./components/product/AddProduct').default);
Vue.component('list-product', require('./components/product/ListProduct').default);
Vue.component('info-product', require('./components/product/InfoProduct').default);
Vue.component('edit-product', require('./components/product/EditProduct').default);
Vue.component('add-task', require('./components/task/AddTask').default);
Vue.component('list-task', require('./components/task/ListTask').default);
Vue.component('edit-task', require('./components/task/EditTask').default);
Vue.component('add-prospect', require('./components/prospect/AddProspect').default);
Vue.component('list-prospect', require('./components/prospect/ListProspect').default);
Vue.component('edit-prospect', require('./components/prospect/EditProspect').default);
Vue.component('add-expense', require('./components/expense/AddExpense').default);
Vue.component('list-expense', require('./components/expense/ListExpense').default);
Vue.component('edit-expense', require('./components/expense/EditExpense').default);
Vue.component('add-reunion', require('./components/reunion/AddReunion').default);
Vue.component('list-reunion', require('./components/reunion/ListReunion').default);
Vue.component('edit-reunion', require('./components/reunion/EditReunion').default);

Vue.component('add-vente', require('./components/vente/AddVente').default);
Vue.component('list-vente', require('./components/vente/ListVente').default);
Vue.component('info-vente', require('./components/vente/InfoVente').default);

Vue.component('add-user', require('./components/setting/RegisterComponent').default);
Vue.component('edit-setting', require('./components/setting/EditSetting').default);
Vue.component('edit-password', require('./components/setting/EditPassword').default);
Vue.component('profil-user', require('./components/setting/ProfilComponent').default);
Vue.component('list-users', require('./components/setting/ListUsers').default);
Vue.component('edit-avatar', require('./components/setting/UserAvatar').default);
Vue.component('info-user', require('./components/setting/InfoUser').default);

Vue.component('add-todo', require('./components/todolist/AddTodo').default);
Vue.component('list-todo', require('./components/todolist/ListTodo').default);
Vue.component('edit-todo', require('./components/todolist/EditTodo').default);

Vue.component('add-devis', require('./components/devis/AddDevis').default);
Vue.component('list-devis', require('./components/devis/ListDevis').default);
Vue.component('info-devis', require('./components/devis/InfoDevis').default);


Vue.component('rapport-vente', require('./components/rapport/RapportVente.vue').default);
Vue.component('rapport-between', require('./components/rapport/RapportBetween.vue').default);
Vue.component('rapport-result', require('./components/rapport/RapportResult.vue').default);

Vue.component('last-history', require('./components/LastHistory').default);




// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
});

