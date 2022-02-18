<template>
   <div >
      <div class="boxCategory">
        <h4>Categories</h4>
        <div>
          <button class="btn cat"
          v-for="(category, index) in categories"
          :key="`category${index}`"
          @click="$emit('getPotCategory', category.slug)">
            {{category.name}}
          </button>
        </div>
      </div>
      <div class="boxTag">
        <h4>Tags</h4>
        <div>
          <button 
          class="btn tag"
          v-for="(tag, index) in tags"
          :key="`tag${index}`"
          @click="$emit('getTagPost', tag.slug)">
            {{tag.name}}
          </button>
        </div>
      </div>

       <button class="btnAll" @click="$emit('getAllPosts')">
      Tutti i post
      </button>
    </div>
</template>

<script>
export default {
  name: "SideBar",

  props: {
    tags: Array,
    categories: Array,
  }
}
</script>

<style scoped lang="scss">
  .btnAll {
    margin-left: 32px;
    padding: 6px;
    background-color: rgb(255, 157, 0);
  }
</style>