<template>
  <div>
    <Dropzone />
    <Posts />
  </div>
</template>

<script>
import Dropzone from './components/Dropzone.vue';
import Posts from './components/Posts.vue';

export default {
  components: {
    Dropzone, Posts
  }
}
</script>

<style lang="sass" scoped>

</style>