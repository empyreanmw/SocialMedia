<template>
	<div>
		<div v-cloak class="list-group" v-for="(post, index) in items" :key="post.id">
			<post v-cloak :data="post" @deleted ="remove(index)"></post>
		</div>
	</div>
</template>

<script>
import Post from './Post.vue';

export default{
	props: ['data'],
	components: {Post},

	data(){
		return {
			items: this.data,
		}
	},

	mounted(){
		var oldThis = this;
		this.$eventHub.$on('create', function(create){
			oldThis.add(create);
		});
	},

	computed: {
		reverseItems() {
			return this.items.reverse();
		}     
	},

	methods:{
		add( post ){
			this.items.push(post);
			flash('Your post has been created!', 'alert-success');
		},

		remove(index) {
			this.items.splice(index, 1)
		}
	}
}
</script>