<template>
  <div class="w-25">
    <input v-model="title" class="form-control my-3" type="text" placeholder="title">
    <input v-model="content" class="form-control my-3" type="text" placeholder="content">
    <div class="mb-3">
      <div ref="dropzone" class="bg-black btn p-5 text-center text-white">
        Upload
      </div>
    </div>
    <button @click.prevent="store" class="btn btn-primary">Add</button>
  </div>
</template>

<script>
import Dropzone from 'dropzone'

export default {
  data: () => ({
    title: '',
    content: '',
    dropzone: null
  }),
  mounted() {
    this.dropzone = new Dropzone(this.$refs.dropzone, {
      url: 'asdfsd',
      autoProcessQueue: false,
      addRemoveLinks: true
    })
  },
  methods: {
    store() {
      const form = new FormData();

      const images = this.dropzone.getAcceptedFiles();
      images.forEach(image => {
        form.append('imgs[]', image)
        this.dropzone.removeFile(image)
      });
      form.append('title', this.title);
      form.append('content', this.content);

      this.title = '';
      this.content = '';

      axios.post('/api/posts', form)
    }
  }
}
</script>

<style lang="sass" scoped>

</style>