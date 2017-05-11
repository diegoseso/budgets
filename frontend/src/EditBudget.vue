<template>
	<div id="budget-edit">
		<h2>Edit budget</h2>
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
				<label>Currency</label>
				<select v-model="budget.currency">
					<option value="">Please select a currency...</option>
					<option value="bajo">EUR</option>
					<option value="normal">USD</option>
				</select>
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
                        <p>
                            <label for="file">Attachment</label>
                            <input ref="avatar" type="file" name="avatar" id="avatar" @change="upload">
			</p>
                        <input type="submit" value="Save Budget" />
		</form>
	</div>
</template>

<script>
	import axios from 'axios';
	export default {
		name: 'budget-edit',
		mounted(){
		},
		data(){
			return {
			           budget: {
                                        id: '',
					name: '',
					provider: 'none',
					amount: '0',
                                        currency: 'EUR',
                                        creator: 'Test',
				}
			};
		},
		methods: {
		    upload: function(e) {
                        e.preventDefault();
                        var files = this.$refs.avatar.files;
                        var data = new FormData();
                        data.append('attachment', files[0]);
                        console.log( data );
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
