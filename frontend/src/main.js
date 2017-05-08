import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue/dist/bootstrap-vue.esm';
import VueRouter from 'vue-router'
import App from './App.vue'
import Home from './Home.vue'
import Help from './Help.vue'
import Budget from './Budget.vue'
import BudgetsList from './BudgetsList.vue'
import AddBudget from './AddBudget.vue'
import EditBudget from './EditBudget.vue'


Vue.use(VueRouter);
Vue.use(BootstrapVue);

const routes = [
	{path: '/create-budget', name: 'create-budget', component: AddBudget},
	{path: '/edit-budget/:id', name: 'edit-budget', component: EditBudget},
	{path: '/budget/:id', name: 'budget', component: Budget},
	{path: '/budgets', component: BudgetsList},
	{path: '/help', component: Help},
	{path: '/home', component: Home},
	{path: '/', component: Home}
];

const router = new VueRouter({
	routes,
	mode: 'history'
});

Vue.component('home', Home);
Vue.component('help', Help);

new Vue({
  el: '#app',
  router,
  render: h => h(App)
});

