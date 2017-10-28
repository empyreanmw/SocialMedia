<template>
<div>
      <div v-cloak class="list-group" v-for="(post, index) in items" :key="post.id">
			<post v-cloak :data="post" @deleted ="remove(index)"></post>
      </div>
</div>
</template>
