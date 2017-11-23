<template>
	<div class="panel panel-default" style="background-color:#E8F5FD">
    <div style="padding:10px;">
       <div class="row">
      <div class="col-xs-1">
        <img :src="this.avatar" class="avatar-rounded" alt="r">          
      </div>
      <div class="col-xs-11">
        	<div class="form-group" >
		    		<textarea @click="editor()" v-on-click-outside="close" style="resize:none;"  class="form-control"  :rows="rows" name="body" id="body" v-model="body"  placeholder="What's on your mind"></textarea>
			    </div>
      </div>
    </div>
		
		<div v-if="this.textareaExtend" class="form-group  text-right">
			<button type="submit"  @click="add" class="btn btn-primary btn-sm">Post</button>
  	</div>	
    </div>
	</div>
</template>
<script>
  import { mixin as onClickOutside } from 'vue-on-click-outside'
export default {
    mixins: [onClickOutside],
  props: ["data"],
  data() {
    return {
      body: "",
      avatar: '/storage/'+ this.data.avatar_path,
      textareaExtend: false,
      textareaRows : 1
    };
  },

  computed: {
    rows()
    {
       return this.textareaRows;
    }
  },

  methods: {
    add() {
      axios
        .post("/posts/" + this.data.name + "/create", { body: this.body })
        .catch(error => {
          flash(error.response.data.errors.body[0], 'alert-danger');
        })
        .then(response => {
          this.body = "";
          this.$eventHub.$emit("create", response.data);
          this.textareaExtend = false;
          this.textareaRows = 1;
        });
    },

    editor()
    {
      this.textareaRows = 4;
      this.textareaExtend = true;
    },

    close() { this.textareaExtend = false;   this.textareaRows = 1 }
  }
};
</script>