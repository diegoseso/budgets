<template>
	<div>
		<h1>Budget details for # {{id}}</h1>
		<div id="budget-details" v-if="budget != null">
			<h2 v-text="budget.name"></h2>
			<p v-text="budget.description"></p>
		</div>
		<span v-else>Loading Budget...</span>
	</div>
</template>

<script>
import axios from 'axios';
export default{
	name: 'budget-details',
	mounted(){
		this.id = this.$route.params.id;

		axios.get('http://localhost:8081/budgets/web/app.php/budget/view/'+this.id)
		     .then(( answer ) => {
		     	this.budget = answer.data;
		     });
	},
	data(){
		return {
	            budget: {
                        id: null,
			name: null,
                        amount:null
		    }
                }
	}
}
</script>
