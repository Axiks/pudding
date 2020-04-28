<template>
<div>
    <input @change="upload" type="file"/>
    <!-- <input v-model="id" placeholder="ID Club"/> -->
</div>
</template>

<script>
  import { UPLOAD_USER_AVATAR_MUTATION } from '../../constants/graphql'
  export default {
    data () {
      return {
      }
    },
    methods: {
      upload ({ target: { files = [] } }) {
        if (!files.length) {
          return
        }

        this.$apollo
          .mutate({
            mutation: UPLOAD_USER_AVATAR_MUTATION,
            variables: {
              file: files[0]
            },
            context: {
              hasUpload: true
            }
          })
      }
    }
  }
</script>