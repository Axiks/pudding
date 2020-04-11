<template>
<div>
    <input @change="upload" type="file"/>
    <!-- <input v-model="id" placeholder="ID Club"/> -->
</div>
</template>

<script>
  import {  UPLOAD_COVER_CLUB_MUTATION } from '../constants/graphql'
  export default {
    props: ['id'],
    data () {
      return {
      }
    },
    methods: {
      upload ({ target: { files = [] } }) {
        console.log(this.id);
        if (!files.length) {
          return
        }

        this.$apollo
          .mutate({
            mutation:  UPLOAD_COVER_CLUB_MUTATION,
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