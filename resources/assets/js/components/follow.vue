<template>
    <div>
        <button @click="toggle()" v-text="buttonText" :class="classes"></button>
    </div>
</template>
<script>
    export default {
        props:['data'],

        data(){
            return {
                isFollowing: this.data.isFollowing
            };
        },

        computed:
        {
            classes()
            {
                return ['modal-prevent', 'btn', 'btn-xs', this.isFollowing ? 'btn-primary' : 'btn-default' ];
            },

            buttonText()
            {
                return this.isFollowing ? 'Following' : 'Follow';
            }
        },



        methods: {
           toggle()
		    {
                if (!this.isFollowing)
                {
                    axios.post('/followers/create', {id: this.data.id});
                    this.isFollowing = true; 
                    axios.post('/posts/newposts', {post: null}).then(
                        response=>{
                        this.$eventHub.$emit("followed", response.data);          

                        }                        
                    );
                }
                else
                {
                    axios.post('/followers/destroy', {id: this.data.id});				
                    this.isFollowing = false;
                }
	    	}
	}
        
    }   
</script>