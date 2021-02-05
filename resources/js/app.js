require('./bootstrap');

window.Vue = require('vue').default;
import VueRouter from 'vue-router';
import routes from './routes';

Vue.use(VueRouter);
Vue.component('add-staticdata', require('./components/staticData/AddStaticData').default);
Vue.component('list-staticdata', require('./components/staticData/ListStaticData').default);
Vue.component('edit-staticdata', require('./components/staticData/EditStaticData').default);
Vue.component('add-employed', require('./components/employe/AddEmploye').default);
Vue.component('list-employed', require('./components/employe/ListEmploye').default);
Vue.component('edit-employed', require('./components/employe/EditEmploye').default);
Vue.component('info-employed', require('./components/employe/InfoEmploye').default);
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
Vue.component('edit-vente', require('./components/vente/EditVente').default);

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
});
