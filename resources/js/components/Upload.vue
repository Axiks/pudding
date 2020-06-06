<template>
<div>
    <input @change="upload" type="file"/>
    <!-- <input v-model="id" placeholder="ID Club"/> -->
</div>
</template>

<script>
  import { UPLOAD_AVATAR_CLUB_MUTATION } from '../constants/graphql'
  export default {
    props: ['id'],
    data () {
      return {
        files: null,
      }
    },
    methods: {
      upload ({ target: { files = [] } }) {
        console.log(this.id);
        if (!files.length) {
          return
        }
        this.files = files[0]

        this.$apollo
          .mutate({
            mutation: UPLOAD_FILES_MUTATION,
            variables: {
              file: files[0],
              id: this.id,
            },
            context: {
              hasUpload: true
            }
          })
      }
    }
  }
</script>