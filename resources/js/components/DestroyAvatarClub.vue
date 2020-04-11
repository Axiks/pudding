<template>
<div>
    <button @click="destroyAvatar()">Destroy avatar</button>
</div>
</template>

<script>
  import { DESTROY_AVATAR_CLUB_MUTATION } from '../constants/graphql'
  export default {
    props: ['id'],
    data () {
      return {
      }
    },
    methods: {
      destroyAvatar (){
        this.$apollo
          .mutate({
            mutation:  DESTROY_AVATAR_CLUB_MUTATION,
            variables: {
              id: this.id,
            }
          })
          .catch((error) => {
          // This should log the error object but is just printing out the message
          console.log(error);
        })
      }
    }
  }
</script>