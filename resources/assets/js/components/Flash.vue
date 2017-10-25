<template>
	<div v-if="show" :class="alertType">
		<span v-text="body"></span>
	</div>
</template>
<script>
export default {
	props: ['message','type'],
	data() {
		return {
			body: '',
			show: false,
		};
	},

	created(){
		if (this.message){
			this.flash(this.message, this.type);
		}

		let oldThis = this;
		this.$eventHub.$on('flash', function(message, type){
			oldThis.flash(message,type);
		})
	},

	computed: {
		alertType()
		{
			return ['alert', 'alert-flash', this.type]
		}
	},


	methods: {
		flash(message, type) {
			this.body = message;
			this.show = true;
			this.type = type;
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