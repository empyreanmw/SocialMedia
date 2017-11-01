<template>
	<div v-if="show" :class="alertType">
		<span v-text="body"></span>
	</div>
</template>
<script>
export default {
	props: ['message'],
	data() {
		return {
			body: '',
			show: false,
			type: 'alert-success'
		};
	},

	created(){
		if (this.message){
			this.flash(this.message);
		}

		let oldThis = this;
		this.$eventHub.$on('flash', function(data){
			oldThis.flash(data);
		})
	},

	computed: {
		alertType()
		{
			return ['alert', 'alert-flash', this.type]
		}
	},


	methods: {
		flash(data) {
			this.body = data.message;
			this.show = true;
			this.type = data.type;
			this.hide();
		},

		hide()
		{
			setTimeout(() => {
				this.show = false;
			}, 3000);
		}
	}
}
</script>

<style type="text/css">
.alert-flash
{
	position: fixed;
	bottom: 25px;
	right: 25px;
}
</style>