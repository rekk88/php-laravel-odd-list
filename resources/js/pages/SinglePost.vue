<template>
  <div class="container">
    <div class="card">
      <div class="card-header">{{post.title}}</div>
      <div class="card-body">
        <h5 class="card-title" v-if="post.category">{{post.category.name}}</h5>
        <p class="card-text">{{post.content}}</p>
        <div v-if="post.tags">
          <span  class="tag p-1" v-for="(tag,index) in post.tags" :key="index">
            {{tag.name}}
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name:"SinglePost",
  data() {
    return {
      post: []
    }
  },
  mounted() {
    axios.get('/api/post/' + this.$route.params.slug)
        .then(response =>{
           console.log(response.data.results);
           this.post = response.data.results;
        });
  }, 
}
</script>

<style lang="scss" scoped>
.tag{
  color:  white;
  background-color:#094985;
  border-radius: 15px;
}
</style>