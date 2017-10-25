<template>
	<div class="col-sm-3 offset-sm-1 blog-sidebar">
		<div class="sidebar-module">
			<img :src="avatar" width="200" height="200">
		</div>

		<div v-if="!edit" class="sidebar-module sidebar-module-inset">		
			<div class="user-info"style="margin-top: 20px; margin-bottom: 20px">
				<p v-text="about"></p>
				<p ><i class="fa fa-map-marker"  aria-hidden="true"></i> <span v-text="location"></span></p>
				<p><i class="fa fa-calendar" aria-hidden="true"></i> Joined {{joined}}</p>
			</div>
		</div>

		<div v-else class="sidebar-module sidebar-module-inset">		
			<div class="avatar-upload">
				<form method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<input class="form-control" type="file" name="avatar" @change="onChange">
					</div>
				</form>
			</div>
			<div class="user-info"style="margin-top: 20px; margin-bottom: 20px">
				<div class="form-group">
					<textarea class="form-control" v-model="about" rows="5" style="resize: none"></textarea>
				</div>
				<div class="form-group">
					<input class="form-control" v-model="location" type="input" name="location">
				</div>
				<p><i class="fa fa-calendar" aria-hidden="true"></i> Joined {{joined}}</p>
			</div>
		</div>

		<div v-if="canUpdate">
			<button v-if="!edit" @click="edit = !edit" style="margin-left:8px;" class="btn btn-primary btn-xs"><i class="fa fa-map-pencil" aria-hidden="true"> </i>Edit info</button>
			<button v-if="edit" @click="saveChanges()" style="margin-left:8px;" class="btn btn-primary btn-xs">Save</button>
			<button v-if="edit" @click="cancel()" style="margin-left:8px;" class="btn btn-primary btn-xs">Cancel</button>
		</div>
	</div>
</template>
<script>
import moment from 'moment'
export default{

	props:['user'],

	data(){
		return {
			avatar: '/storage/'+ this.user.avatar_path,
			about: this.user.data.about,
			edit: false,
			location: this.user.data.location,
			avatarFile:'',
		}
	},
	computed : {
		joined()
		{
			return moment(this.user.created_at).format("MMM Do YYYY");   
		},
		canUpdate()
		{
			return this.authorize(user => this.user.id == user.id);
		}
	},

	methods : {
		onChange(e)
		{
			if(! e.target.files.length)	return;

			let avatar = e.target.files[0];

			let reader = new FileReader();

			reader.readAsDataURL(avatar);

			reader.onload = e => {
				this.avatar = e.target.result;
			};
			
			this.avatarFile = avatar;
		},

		cancel()
		{
			this.avatar = '/storage/'+ this.user.avatar_path;
			this.edit = false;
			this.about = this.user.data.about;
			this.location = this.user.data.location
		},

		uploadAvatar(avatar)
		{
			let data = new FormData();

			data.append('avatar', avatar);

			axios.post('/profiles/'+ this.user.name +'/avatar', data);
		},

		saveChanges()
		{
			if (this.avatarFile != '')
			{
				this.uploadAvatar(this.avatarFile);
			}

			axios.post('/profiles/'+ this.user.name +'/userinfo', {about: this.about, location: this.location}).then(response => {
				this.about = response.data.about;
				this.location = response.data.location;
				this.edit = false;
				flash('Your profile info has been updated!', 'alert-success');
			});
		}
	}	
}
</script>