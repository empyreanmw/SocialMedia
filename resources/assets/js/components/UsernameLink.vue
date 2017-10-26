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


    <div v-if="showHover"  @mouseleave="showHover=false" class="panel panel-default" style="padding: 10px; position:absolute; z-index:1">
      <div class="level">
          <img  style="width:50px; height:50px; border-radius: 75px" :src="'/storage/'+data.avatar_path">
          <div class="flex"></div>
          <follow  :data="data"></follow>
      </div>
   
        <div style="margin-top: 30px">
        <strong style="position:absolute; top:60px; font-size: 15px">{{data.display_name}}</strong>       
            <ul style="list-style: none; display: table; padding: 0px; "> 
              <li style="float: left; margin-right: 15px">
                <a href="#">
                  <span style="color:#657786; font-weight: bold">Following</span> <br>
                  <span>{{data.followingCount}}</span>
                </a>
              </li>
              <li style="float: left; margin-right: 15px" >
                <a href="#">
                  <span style="color:#657786; font-weight: bold">Followers</span> <br>
                  <span>{{data.followersCount}}</span>
                </a>
              </li> 
              <li style="float: left">
                <a href="#">
                  <span style="color:#657786; font-weight: bold">Posts</span> <br>
                  <span>{{data.postCount}}</span>
                </a>
              </li>
            </ul>
          </div>
    </div>
  </div>


</div>
</template>
<script>
import Follow from "./Follow.vue";
export default {
  props: ["data"],

  data() {
    return {
      showHover: false
    };
  }
};
</script>