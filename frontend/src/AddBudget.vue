<template>
	<div id="budget-add">
		<form class="form-style-9" v-on:submit.prevent="saveBudget">
		    <h2>Create new budget</h2>
                    <ul>
                        <li>
                            <input type="text" name="name" class="field-style field-split align-left" placeholder="Budget name" v-model="budget.name" />
                            <input type="number" name="field2" class="field-style field-split align-right" placeholder="Amount" v-model="budget.amount" />
                        </li>
                        <li>
                           <p>
				<label>currency</label>
				<select class="field-style field-full align-none" v-model="budget.currency">
			            <option value="">Please select a currency...</option>
				    <option value="eur">EUR</option>
				    <option value="usd">USD</option>
				</select>
			     </p>
                        </li>
                        <li>
                            <input type="text" name="field3" class="field-style field-full align-none" placeholder="Description..." />
                        </li>
                        <li>
                       	    <p>
				<label>Provider</label>
				<select class="field-style field-full align-none" v-model="budget.provider">
			            <option value="">Please select a provider...</option>
				    <option value="bajo">Paper provider</option>
				    <option value="normal">Electronic provider</option>
				    <option value="alto">Furniture provider</option>
				</select>
			     </p>
                        </li>
                        <li>
                            <input type="submit" value="Save budget" />
                        </li>
                    </ul>
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
