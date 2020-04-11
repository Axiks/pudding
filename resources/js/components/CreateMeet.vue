<template>
  <div class="component">
    <div class="flex flex-column mt3">
      <input
        class="mb2"
        v-model="title"
        type="text"
        placeholder="A title">
      <input
        class="mb2"
        v-model="description"
        type="text"
        placeholder="The Description">
      <input
        class="mb2"
        v-model="beginning_date"
        type="text"
        placeholder="A beginning date">
      <input
        class="mb2"
        v-model="end_date"
        type="text"
        placeholder="The end date">
      <input
        class="mb2"
        v-model="map_point"
        type="text"
        placeholder="A map point">
    </div>
    <button @click="createMeet()">Submit</button>
  </div>
</template>

<script>
  import { CREATE_MEET_MUTATION } from '../constants/graphql'
  export default {
    props: ['club_id'],
    name: 'CreateMeet',
    data () {
      return {
        title: '',
        description: '',
        beginning_date: '2019-09-20 10:00:00',
        end_date: '2019-09-22 16:00:00',
        map_point: '37.235,-115.811111',
        user_id: 1,
      }
    },
    methods: {
      createMeet () {
        console.log(this.club_id)
        console.log(this.$data)
        // ... you'll implement this in a bit
        const { title, description, beginning_date, end_date, map_point, club_id, user_id } = this.$data
        this.$apollo.mutate({
            mutation: CREATE_MEET_MUTATION,
            variables: {
            title,
            description,
            beginning_date,
            end_date,
            map_point,
            club_id: this.club_id,
            user_id,
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