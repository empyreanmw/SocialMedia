<template>
	<div>
		<div v-if="showPostCount"  @click="loadNewPosts()" class="text-center iddle-posts">
			<span>{{postCount}} new posts</span>
		</div>
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
			items: _.orderBy(this.data, 'id', 'desc'), //set collection in descending order
			postCount: 0,
			showPostCount : false,
			newPosts: []
		}
	},

	mounted(){
		if(window.location.pathname == "/")
		{
			this.checkForNewPosts();		
		}
				
		var oldThis = this;
		this.$eventHub.$on('create', function(create){
			oldThis.add(create);
		});

		this.$eventHub.$on('followed', function(data){
			this.ajaxRequest();
		});
	},


	methods:{
		add( post ){
			this.items.unshift(post);
		    flash('Your post has been created!', 'alert-success');
		},
		
		checkForNewPosts()
		{
			this.ajaxRequest();
			   
			setTimeout(this.checkForNewPosts, 10000);
		},

		remove(index) {
			this.items.splice(index, 1)
		},

		loadNewPosts()
		{		
			var i =0;
			for (i = 0; i < _.size(this.newPosts); i++)
			{
				this.items.unshift(this.newPosts[i]);
			}

			this.postCount = 0;
			this.newPosts = [];
			this.showPostCount = false;     	
		},

		ajaxRequest()
		{
			axios.post('/posts/newposts', {posts: this.items}).then(response => {
				this.setPostCount(response)
			   });
		},

		setPostCount(response)
		{
			this.postCount = _.size(response.data);
			this.postCount > 0 ? this.showPostCount = true : this.showPostCount = false;
			this.newPosts = _.orderBy(response.data, 'id', 'asc');			
		}
	}
}
</script>