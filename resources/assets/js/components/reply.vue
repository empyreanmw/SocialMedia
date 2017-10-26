<template>
	<div style="margin-bottom: 10px;    border-bottom: 1px solid #e6ecf0;">
		<div class="level" style="margin-bottom: 10px;">
		<username-link :data="data.owner"></username-link>
			<small class="flex"> {{ago}}</small> 
			<div class="dropdown">
				<a class="dropdown-toggle pointer"  data-toggle="dropdown"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
				<ul class="dropdown-menu">
					<li v-if="canUpdate"><a class="pointer" @click="remove()" >Delete reply</a></li>
					<li><a class="pointer">Report reply</a></li>

				</ul>
			</div>
		</div>
		<p v-html="data.body"></p>
		<favorited :data = "data"></favorited>
	</div>
</template>

<script>
import moment from 'moment';
import Favorited from './Favorited.vue';

export default {
	props: ['data'],
	components: {Favorited},

	data(){
		return {

		};
	},

	computed: {
		ago()
		{
			return moment(this.data.created_at).fromNow();
		},
		canUpdate()
		{
			return this.authorize(user => this.data.user_id == user.id);
		}

	},



	methods: {
		remove()
		{
			axios.delete('/replies/' + this.data.replied_id +'/'+ this.data.id + '/delete');
			this.$emit('deletedReply', this.data.id);
			flash('Your reply has been deleted!', 'alert-success');
		}
	}
}
</script>