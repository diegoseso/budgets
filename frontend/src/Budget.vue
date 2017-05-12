<template>
	<div id="budget-view">
	    <form class="form-style-9">
		<h2>Edit budget</h2>
                <budget-form ref="budget" ></budget-form>	
	    </form>
        </div>
</template>

<script>
    import BudgetForm from './components/BudgetForm.vue';
    import axios from 'axios';
    export default{
	name: 'budget-details',
	mounted(){
		this.id = this.$route.params.id;

		axios.get('http://localhost:8081/budgets/web/app.php/budget/view/'+this.id)
		     .then(( answer ) => {
                        console.log( answer );
		     	this.budget = answer.data.data;
                        this.$refs.budget.budget = this.budget;
		     });
	},
	components:
        {
            'budget-form': BudgetForm
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
