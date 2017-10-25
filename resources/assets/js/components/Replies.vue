<template>
	<div>
		<new-reply  @created="add" :post-id="postId"></new-reply>
		<div v-for="(reply, index) in items" :key="reply.id">
			<reply :data="reply" @deletedReply="remove(index)"></reply>
		</div>

		
	</div>
</template>

<script>
import Reply from './Reply.vue';
import NewReply from './NewReply.vue';


export default{
	props: ['data', 'postId'],
	components: {Reply, NewReply},

	data(){
		return {
			items: this.data,
		}
	},

	methods: {
		add( reply ){
			
			this.items.push(reply);
			this.$emit('added');
			flash('Your reply has been posted!', 'alert-success');
		},

		remove(index) {
			this.items.splice(index, 1);
			this.$emit('removed');
		},

	},

}
</script>