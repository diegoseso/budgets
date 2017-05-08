<template>
	<div>
		<ul id="budgets-list" v-if="budgets != null">
			<li v-for="budget in budgets">
				<strong>{{budget.description}}</strong>
				<p>
					<router-link :to="{name: 'budget', params:{id: budget.id}}">View</router-link>
					<router-link :to="{name: 'edit-budget', params:{id: budget.id}}">Edit</router-link>
					<span v-if="showDelete != budget.id">
							<a @click="deleteBudget(budget.id)" style="cursor:pointer;">delete</a>
					</span>
				 	<span v-else>
				 		<p>Are you sure you want to delete the budget?</p>
				 		<button @click="cancelDeletion()">Cancel</button>
				 		<button @click="confirmDeletion( budget.id )">Delete</button>
					</span>
				</p>
			</li>
		</ul>
		<span v-else>Loading Budgets...</span>
	</div>
</template>

<script>
import axios from 'axios';
export default {
  name: 'budgets-list',
  mounted() {
  	this.getBudgets();
  },
  data () {
    return {
      texto: 'Budgets List',
      budgets: null,
      showDelete: null
    }
  },
  methods: {
  	getBudgets(){
  		axios.get('/api/budgets.json')
  			 .then((answer) => {
  			 	this.budgets = answer.data.data;
  			 });
  	},
  	deleteBudget( id ){
  		this.showDelete = id;
  	},
  	cancelDeletion(){
  		this.showDelete = null;
  	},
  	confirmDeletion( id ){
  		axios.get('../delete-restaurante/'+id)
  		     .then(( answer ) => {
  		     	this.showDelete = null;
  		     	this.getBudgets();
  		     });
  	}
  }
}
</script>

<style lang="scss">
	#restaurantes-list{
		padding: 5px;
		li{
			margin-top: 10px;
			width: 30%;
			height: 120px;
			border: 1px solid #ddd;
			background: #eee;
			padding: 20px;
			overflow:hidden;
		}
	}
</style>
