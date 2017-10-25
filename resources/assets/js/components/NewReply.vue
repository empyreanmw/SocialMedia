<template>
	<div style="background-color: #e6ecf0; margin-top:10px">
		<div @click="replyButton=true" class="form-group">
			<textarea style="resize:none;  box-shadow: none" class="form-control" v-model="body" rows="1" name="body" id="replyBody"  required placeholder="Write a comment.."></textarea>	
		</div>

		<div v-if="replyButton" class="form-group">
			<button type="submit" class="btn btn-primary btn-sm" @click="addReply">Post</button>
		</div>
	</div>
</template>
<script>

import 'at.js';
import 'jquery.caret';

export default{
	props:['postId'],

	data() {
		return {
			body: '',
			endpoint: '/replies/create',
			replyButton: false
		};
	},

	mounted() {
		$('#replyBody, #body').atwho({
			at: "@",
			delay: 700,
			callbacks: {
				remoteFilter: function(query, callback) {
					$.getJSON("/api/users", {name: query}, function(usernames){
						callback(usernames)
					})
				}
			}
		});
	},

	methods: {
		addReply(){
			axios.post(this.endpoint, {body: this.body, post_id: this.postId})
			.then(response => {
				this.body = '';
				this.$emit('created', response.data);
				this.replyButton = false;
			});
		}
	}
}
</script>