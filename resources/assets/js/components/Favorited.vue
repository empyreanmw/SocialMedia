<template>
	<span class="move-right">
		<span @click="toggle"><i style="margin-right: 10px" :class="classes" aria-hidden="true"></i> <span v-text="favoritesCount"></span></span>
	</span>
</template>
<script>
export default {
	props:['data'],
	data(){
		return {
			favoritesCount: this.data.favoritesCount,
			isFavorited: this.data.isFavorited,
			endpoint: '/'+this.data.favoritesParent+'/'+ this.data.id
		};
	},

	computed: {
		classes()
		{
			return ['modal-prevent ', this.isFavorited ? 'fa fa-heart' : 'fa fa-heart-o'];
		}
	},

	methods: {
		toggle()
		{
			if (this.isFavorited)
			{
				axios.delete(this.endpoint + '/unfavorite');
				this.isFavorited = false;
				this.favoritesCount--;
			}
			else
			{
				axios.post(this.endpoint +'/favorite');				
				this.isFavorited = true;
				this.favoritesCount++;
			}
		}
	}
}
</script>