<template>
  <header class="">
    <nav class="container">
      <ul>
        <li>
          <router-link :to="{ name: 'home' }"> Home </router-link>
        </li>
        <li>
          <router-link :to="{ name: 'posts' }"> I Post </router-link>
        </li>
        <li>
          <router-link :to="{ name: 'about' }"> About </router-link>
        </li>
        <li>
          <router-link :to="{ name: 'contacts' }"> Contatti </router-link>
        </li>
      </ul>
    </nav>
  </header>
</template>

<script>
export default {
  name: "Header",
}
</script>

<style scoped lang="scss">

</style>