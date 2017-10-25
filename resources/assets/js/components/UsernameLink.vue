<template>
  <div>
      	<img class="avatar-rounded" :src="'/storage/'+data.avatar_path">   &nbsp; 
		<a  
        class="modal-prevent" 
        data-toggle="popover"  data-trigger="hover"  
        data-html = "true" 
        data-content="ada"
        data-placement="bottom" 
        :href="'/profiles/' + data.name">
        {{data.name}} &nbsp;
        </a>
  </div>
</template>
<script>
import Follow from './Follow.vue';
    export default{
        props: ['data'],

        data(){
            return {

            };
        },
    }
</script>