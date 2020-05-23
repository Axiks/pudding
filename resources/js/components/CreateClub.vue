<template>
  <div class="component">
    <div class="flex flex-column mt3">
    <h2>Створити клуб</h2>
      <p>Ім'я</p><input
        class="mb2"
        v-model="name"
        type="text"
        placeholder="A name">
      <p>Опис</p><input
        class="mb2"
        v-model="description"
        type="text"
        placeholder="The Description">
    </div>
    <button @click="createClub()">Submitt</button>
  </div>
</template>

<script>
  import { CREATE_CLUB_MUTATION } from '../constants/graphql'
  import { ME_DATA_QUERY } from '../constants/graphql'
  export default {
    name: 'CreateClub',
    data () {
      return {
        me: [],
        name: ' ',
        description: ' ',
        cover_src: 'def',
        creator_id: null
      }
    },
    apollo: {
      // Simple query that will update the 'hello' vue property
      me:{
          query: ME_DATA_QUERY,
      }  
    },
    methods: {
      createClub () {
        console.log(this.$data)
        // ... you'll implement this in a bit
        this.$data.creator_id = this.me.id + ""
        const { name, description, cover_src, creator_id} = this.$data
        this.$apollo.mutate({
            mutation: CREATE_CLUB_MUTATION,
            variables: {
            name,
            description,
            cover_src,
            creator_id
            }
        })
        .catch((error) => {
          // This should log the error object but is just printing out the message
          console.log(error);
        })
        // this.$router.push({ name: "clubs"})
      }
    }
  }
</script>