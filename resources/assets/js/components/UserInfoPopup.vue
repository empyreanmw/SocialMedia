<template>
  <div>
      <div class="panel panel-default" style="padding: 10px; z-index:1; max-width:300px">
      <div class="level">
          <img  style="width:50px; height:50px; border-radius: 75px" :src="'/storage/'+data.avatar_path">
          <div class="flex"></div>
          <follow  :data="data"></follow>
      </div>
   
        <div style="margin-top: 10px">
        <strong style="font-size: 15px">{{data.display_name}}</strong><br>   
        <small>@{{data.name}}</small>  
          <div style="margin-top:5px">
            <p>
              {{data.data.about}}
            </p>
          </div>
            <ul style="list-style: none; display: table; padding: 0px; margin-top:20px"> 
              <li style="float: left; margin-right: 15px">
                <a  :href="'/profiles/'+data.name+'/following'">
                  <span class="modal-prevent" style="color:#657786; font-weight: bold">Following</span> <br>
                  <span>{{data.followingCount}}</span>
                </a>
              </li>
              <li style="float: left; margin-right: 15px" >
                <a :href="'/profiles/'+data.name+'/followers'">
                  <span class="modal-prevent" style="color:#657786; font-weight: bold">Followers</span> <br>
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
</template>

<script>
import Follow from './Follow.vue';

    export default {
        props: ['data'],
        data(){
            return {

            };
        }
    }

</script>
