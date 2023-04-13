<template>
  <div>
    <div class="title">Title: {{ post.title }}</div>
    <div class="content">Content: {{ post.content }}</div>
    <div v-for="image in post.images" class="images">
      <img class="p-2" :src="image.preview_url" alt="">
      <img class="p-2" style="max-width: 300px;" :src="image.url" alt="">
    </div>
  </div>
</template>

<script>
export default {
  data: () => ({
    post: {}
  }),
  mounted() {
    this.getPost()
  },
  methods: {
    getPost() {
      axios.get('/api/posts').then(res => this.post = res.data.data)
    }
  }
}
</script>

<style lang="sass" scoped>

</style>