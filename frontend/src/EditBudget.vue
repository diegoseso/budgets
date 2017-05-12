<template>
	<div id="budget-edit">
            <form class="form-style-9" v-on:submit.prevent="saveBudget">
		<h2>Edit budget</h2>
                <budget-form ref="budget" ></budget-form>	
	    </form>
	</div>
</template>

<script>
        import BudgetForm from './components/BudgetForm.vue';
	import axios from 'axios';
	export default {
                name: 'budget-edit',
		mounted(){
                    var id = this.$route.params.id;
	            axios.get( 'http://localhost:8081/budgets/web/app.php/budget/view/' + id ) 
                        .then((answer)=>{
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
                            budget:null
			};
		},
		methods: {
		    upload: function(e) {
                        e.preventDefault();
                        var files = this.$refs.avatar.files;
                        var data = new FormData();
                        data.append('attachment', files[0]);
                        axios.post('http://localhost:8081/budgets/web/app.php/budget/attach', data)
                        .then(( answer )=>{
                            console.log( answer );
                        });
                    },
                    saveBudget(){
                                var router = this.$router;
                                this.budget.id = this.$route.params.id;
				var params = "json="+JSON.stringify(this.budget);
				
                                axios.post('http://localhost:8081/budgets/web/app.php/budget/edit', params)
				     .then((answer)=>{
				     	if( answer.data.status == 'success' ){
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
