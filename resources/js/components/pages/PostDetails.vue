<template>
  <div class="container">
    <h2>
      {{post.title}}
    </h2>
    <h4 v-if="post.category">
      {{post.category.name}}
    </h4>
    <h5 v-for="(tag, index) in post.tags"
    :key="`tag${index}`">
      {{tag.name}}
    </h5>
    <p>
      {{post.content}}    
    </p>
  </div>
</template>

<script>
export default {
  name: 'PostDetails',

  data(){
    return{
      apiUrl: 'http://127.0.0.1:8000/api/posts/',

      post: {
        title: '',
        content: '',
        category: {},
        tags: [],
      },
    }
  },

  methods: {

    getApi(){
      axios.get(this.apiUrl + this.$route.params.slug)
      .then(res => {
        this.post = res.data;
      })
    }
  },

  mounted(){
    this.getApi();

  }
}
</script>

<style scoped lang="scss">
  .container {
    margin: 58px auto;
  }
</style>