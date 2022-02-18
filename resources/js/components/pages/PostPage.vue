<template>
  <main class="allPosts">

    <section >
      <h2>
        {{titlePosts}}
      </h2>
      <div v-if="posts">
        <Post
          v-for="post in posts"
          :key="`${post.id}`"
          :postSingle="post"
        />
        <div v-if="allPosts">
          <button
            class="btn_page"
            @click="getPosts(paginate.current - 1) "
            :disabled = "paginate.current === 1">
          &#60;
          </button>

          <button
            class="btn_page"
            v-for="page in paginate.last"
            :key="page.id"
            @click="getPosts(page)"
            :disabled = "paginate.current === page"> 
            {{page}}
          </button>

          <button
            class="btn_page"
            @click="getPosts(paginate.current + 1)"
            :disabled = "paginate.current === paginate.last">
          &#62;
          </button>
        </div>
      </div>
      <div v-else>
        <h3> Caricamento... </h3>
      </div>


    </section>

    <SideBar
      :tags="tags"
      :categories="categories"
      @getPotCategory="getCategory"
      @getTagPost=" getTag"
      @getAllPosts="getPosts"
    />

  </main>
</template>

<script>
import Post from '../partials/Post';

import SideBar from '../partials/SideBar';

export default {
  name: "PostPage",

  components:{
    Post,
    SideBar,
  },

  data(){
    return {
      apiUrl: "http://127.0.0.1:8000/api/posts",
      posts: null,
      paginate: {},
      tags:[],
      categories: [],
      success: true,
      error_msg: "",
      titlePosts: "Tutti i post",
      allPosts: true,
    }
  },

  mounted(){
    this.getPosts();
  },

  methods: {
    getPosts(page=1){
      this.reset();

      axios.get(this.apiUrl + "?page=" + page)
        .then(res => {
          this.posts = res.data.posts.data;
          this.tags = res.data.tags;
          this.categories = res.data.categories;
          this.paginate = {
            current: res.data.posts.current_page,
            last: res.data.posts.last_page
          }
          console.log(this.paginate);
        });
    },

    getCategory(slug_category){
      this.reset();

      axios.get(this.apiUrl + "/postcategory/" + slug_category)
      .then(res =>{
        this.posts = res.data.category.posts;
        this.titlePosts = 'I post per la categoria: ' + res.data.category.name;
        this.allPosts= false;

        if(!res.data.succes){
          this.error_msg = res.data.error;
          this.success = false;
        }
      });
    },

    getTag(slug_tag){
      this.reset();

      axios.get(this.apiUrl + "/posttag/" + slug_tag)
      .then(res =>{
        this.posts = res.data.tag.posts;
        this.titlePosts = 'I post per il tag: ' + res.data.tag.name;
        this.allPosts= false;

        if(!res.data.succes){
          this.error_msg = res.data.error;
          this.success = false;
        }
      });
    },

    reset(){
      this.posts = null;
      this.success = true;
      this.error_msg = "";
      this.titlePosts = 'Tutti i post';
      this.allPosts = true;
    }
  }
}
</script>

<style scoped lang="scss">

  

</style>