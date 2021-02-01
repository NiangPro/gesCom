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
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
});
