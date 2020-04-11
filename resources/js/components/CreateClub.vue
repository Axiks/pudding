<template>
  <div class="component">
    <div class="flex flex-column mt3">
      <input
        class="mb2"
        v-model="name"
        type="text"
        placeholder="A name">
      <input
        class="mb2"
        v-model="description"
        type="text"
        placeholder="The Description">
    </div>
    <button @click="createClub()">Submit</button>
  </div>
</template>

<script>
  import { CREATE_CLUB_MUTATION } from '../constants/graphql'
  export default {
    name: 'CreateClub',
    data () {
      return {
        name: '',
        description: '',
        background_src: '',
        creator_id: '1'
      }
    },
    methods: {
      createClub () {
        console.log(this.$data)
        // ... you'll implement this in a bit
        const { name, description, background_src, creator_id } = this.$data
        this.$apollo.mutate({
            mutation: CREATE_CLUB_MUTATION,
            variables: {
            name,
            description,
            background_src,
            creator_id
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