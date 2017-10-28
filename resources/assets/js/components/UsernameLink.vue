<template>
<div>
  <div @mouseleave="showHover = false">
      	<img class="avatar-rounded" :src="'/storage/'+data.avatar_path">   &nbsp; 
		    <a @mouseover="showHover = true"
        class="modal-prevent" 
        :href="'/profiles/' + data.name">
        {{data.display_name}} &nbsp;
        </a>
        <small class="flex"> @{{data.name}} -  &nbsp; </small> 

    <user-info-popup style="position:absolute; z-index:1" v-if="showHover" @mouseleave="showHover=false"   :data="data"></user-info-popup>
    
  </div>
</div>
</template>
<script>
import UserInfoPopup from "./UserInfoPopup.vue";
export default {
  props: ["data"],

  data() {
    return {
      showHover: false
    };
  }
};
</script>