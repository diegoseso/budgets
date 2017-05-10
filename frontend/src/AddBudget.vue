<template>
	<div id="budget-add">
		<h2>Create new budget</h2>
		<form v-on:submit.prevent="saveBudget">
			<p>
				<label>Description</label>
				<input type="text" v-model="budget.name" />
			</p>
			<p>
				<label>Total Amount</label>
				<input type="text" v-model="budget.amount" />
			</p>
			<p>
				<label>Provider</label>
				<select v-model="budget.provider">
					<option value="">Please select a provider...</option>
					<option value="bajo">Paper provider</option>
					<option value="normal">Electronic provider</option>
					<option value="alto">Furniture provider</option>
				</select>
			</p>
			<input type="submit" value="Save Budget">
		</form>
	</div>
</template>

<script>
	import axios from 'axios';
	export default {
		name: 'budget-add',
		mounted(){

		},
		data(){
			return {
			           budget: {
					name: '',
					provider: 'none',
					amount: 0
				}
			};
		},
		methods: {
			saveBudget(){
				var router = this.$router;

				var params = "json="+JSON.stringify(this.budget);
				axios.put('http://localhost:8081/budgets/web/app.php/budget/add', params)
				     .then((answer)=>{
				     	if( answer.data.status == 'success'){
				     		router.push('/budgets');
				     	}

				     })
				     .catch((error)=>{
				     	console.log(error);
				     });
			}
		}
	}
</script>
