<template>
	<div>
		<a v-if="postShow" class="panel panel-default list-group-item pointer test" data-toggle="modal" :data-target="'#'+ data.id" style="margin-bottom: 10px;">
			<div class="panel-body" id="test">
				<div class="level" style="margin-bottom: 10px">
				<username-link  :data="data.owner"></username-link>
				
					<small class="flex"> {{ago}}</small> 
					<div class="dropdown">
						<a class="dropdown-toggle pointer"  data-toggle="dropdown"><i style="font-size:20px" class="fa fa-caret-down" aria-hidden="true"></i></a>
						<ul class="dropdown-menu">
							<li><a class="pointer">Link to the post</a></li>
							<li v-if="canUpdate"><a class="pointer" @click="removePost" >Delete post</a></li>
						</ul>
					</div>
				</div>
				<p  v-html="data.body"></p>
				<br>
				<div class="post-footer">     
					<span class="move-right"><i style="margin-right: 10px" class="fa fa-comment-o" aria-hidden="true"></i>
						<span v-text="repliesCount"></span>
					</span> 
					<favorited :data = "data"></favorited>
				</div>
			</div>
		</a>
		<div :id="data.id" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-body">
						<div class="panel-body">
							<div class="level" style="margin-bottom: 10px">
							<username-link :data="data.owner"></username-link>
							
								<small class="flex">{{ago}}</small> 
								<div class="dropdown">
									<a class="dropdown-toggle pointer"  data-toggle="dropdown"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
									<ul class="dropdown-menu">
										<li><a class="pointer">Link to the post</a></li>
										<li v-if="canUpdate"><a class="pointer" @click="removePost" >Delete post</a></li>					
									</ul>
								</div>
							</div>
							<p v-html="data.body"></p>
							<br>
							<div class="post-footer">     
								<span class="move-right"><i style="margin-right: 10px" class="fa fa-comment-o" aria-hidden="true"></i>
									<span v-text="repliesCount"></span>
								</span> 
								<favorited :data = "data"></favorited>
							</div>
							<div class="reply-pannel">
								<replies  :data="data.replies" :postId= "data.id" @added="repliesCount++"></replies>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<p class="text-center">Placeholder</p>
					</div>
				</div>

			</div>
		</div>
	</div>
</template>

<script>
import Replies from './Replies.vue';
import Favorited from './Favorited.vue';
import moment from 'moment';

export default {
	props: ['data'],
	components: { Replies, Favorited},

	data() { 
		return{		
			repliesCount: this.data.repliesCount
		};
	},

	computed: {
		ago()
		{
			return moment(this.data.created_at).fromNow();
		},

		modalTarget()
		{
			return this.data.id ? this.data.id : 'postId';
		},

		postShow() //determines whether should we show the post or not 
		{
			return this.getCurrentUrl() == "notifications" ? false : true;
		},

		canUpdate()
		{
			return this.authorize(user => this.data.user_id == user.id);
		}

	},

	methods: {
		removePost(){
			axios.delete('/posts/' + this.data.id + '/delete');
			this.$emit('deleted', this.data.id);
			flash('Your post has been removed!', 'alert-success');
		},

		alert()
		{
			alert("gi");
		},

		getCurrentUrl()
		{
			let url = window.location.pathname;
			let array = url.split('/');

			let lastsegment = array[array.length-1];

			return lastsegment;
		}
	}	
}

</script>