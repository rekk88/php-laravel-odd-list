<template>
  <div class="container">
    <div class="row">
      <div class="col-sm-6" v-for="post in posts" :key="post.id"> 
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">{{post.title}}</h5>
            <p>{{dataFormat(post.created_at)}}</p>
            <p class="card-text">{{cutPost(post.content,150)}}</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
    </div>
    <!-- <nav aria-label="Page nav Example" class="mt-4"> 
      <ul class="pagination">
        <li class="page-item" :class="{'disabled' : currentPage == 1}">
          <button class="page-link"  @click="getPosts(currentPage - 1)">Previous</button>
          </li>
        <li class="page-item" :class="{'disabled' : currentPage == lastPage}">
          <button class="page-link" @click="getPosts(currentPage + 1)">Next</button>
          </li>
      </ul>
    </nav> -->


    <nav aria-label="Page nav Example" class="mt-4"> 
      <ul class="pagination">
        <li class="page-item" :class="{'disabled' : currentPage == 1}">
          <button class="page-link"  @click="getPosts(currentPage - 1)">Previous</button>
        </li>

        <li class="page-item" :class="{'active' : currentPage == i}" v-for="i in lastPage" :key="i"><a href="#" class="page-link" @click="getPosts(i)">{{i}}</a></li>
        
        <li class="page-item" :class="{'disabled' : currentPage == lastPage}">
          <button class="page-link" @click="getPosts(currentPage + 1)">Next</button>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
export default {
  name:"Main",
  data() {
    return {
       apiCall: 'http://localhost:8000/api/posts',
       posts : [], //variabile che contiene tutti i post(dopo la chiamata axios)
       currentPage : "",
       lastPage : "",

    }
  },
  created() {
    this.getPosts(1)
  },
  methods: {
    getPosts(pagePost){
      axios.get(this.apiCall,{
              params : {page: pagePost}
            })
           .then(response => {
              // console.log(response.data.results);

              // senza paginate
              // this.posts = response.data.results; 
              this.posts = response.data.results.data;
              console.log(response.data);
              this.currentPage = response.data.results.current_page;
              this.lastPage = response.data.results.last_page;

              console.log(response.data.results.current_page);
           })
    },
    cutPost(text,maxLength){
      if(text.length > maxLength){
        return text.substr(0,maxLength) + '...';
      }
      return text;
    },
    dataFormat(data){
      const postData = new Date(data);

      return postData.getDate() + '/' + (postData.getMonth()+1) + '/' + postData.getFullYear();
    }
  },
}
</script>

<style lang="scss" scoped>

</style>