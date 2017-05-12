<template>
    <div id="budget-add">
        <form class="form-style-9" v-on:submit.prevent="saveBudget">
            <h2>Create new budgets</h2>
            <budget-form ref="budget" ></budget-form>	
        </form>
    </div>
</template>

<script>
    import BudgetForm from './components/BudgetForm.vue';
    import axios from 'axios';
    export default {
	name: 'budget-add',
	mounted(){
	},
        components:
        {
            'budget-form': BudgetForm
        },
        data(){
			return {
				};
		},
		methods: {
			saveBudget(){
				var router = this.$router;
                                var params = "json="+JSON.stringify( this.$refs.budget.budget );
			         	
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
