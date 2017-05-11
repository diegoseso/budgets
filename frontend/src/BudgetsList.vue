<template>
	<div>
		<ul id="budgets-list" v-if="budgets != null">
			<li v-for="budget in budgets">
				<div style="border:1px;background-color:#f7f7f7;border-radius:4px">
                                    <strong>{{budget.name}}</strong>
                                    <h1 style="text-align:center">{{budget.amount}} {{budget.currency}}</h1>
				    <p style="text-align:center">
					<router-link :to="{name: 'budget', params:{id: budget.id}}"><span class="glyphicon glyphicon-sunglasses" style="color:#767777"></span>View</router-link>
					<router-link :to="{name: 'budget-edit', params:{id: budget.id}}"><span class="glyphicon glyphicon-edit" style="color:#767777"></span>Edit</router-link>
					<span v-if="showDelete != budget.id">
							<span class="glyphicon glyphicon-remove" style="color:#767777"></span><a @click="deleteBudget(budget.id)" style="cursor:pointer;text-decoration:underline">delete</a>
					</span>
				 	<span v-else>
				 		<p>Are you sure you want to delete the budget?</p>
				 		<button @click="cancelDeletion()">Cancel</button>
				 		<button @click="confirmDeletion( budget.id )">Delete</button>
					</span>
				    </p>
                                </div>
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
      showDelete: null,
      budget:{
          id:null
      }
    }
  },
  methods: {
  	getBudgets(){
  	       axios.get('http://localhost:8081/budgets/web/app.php/budget/list')
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
            axios.delete('http://localhost:8081/budgets/web/app.php/budget/delete/'+ id )
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
	},
       span > glyphicon{
           color:#dddddd
       }
</style>
