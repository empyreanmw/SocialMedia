<template>
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="form-group">
				<textarea style="resize:none; border:none; box-shadow: none" class="form-control" name="body" id="body" v-model="body"  placeholder="What's on your mind"></textarea>
			</div>

			<div class="form-group">
				<button type="submit" @click="add" class="btn btn-primary btn-sm pull-right">Post</button>
			</div>
		</div>
	</div>
</template>
<script>
export default {
  props: ["data"],
  data() {
    return {
      body: ""
    };
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
        });
    }
  }
};
</script>