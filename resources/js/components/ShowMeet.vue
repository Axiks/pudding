/* Dont All Works */
<template>
  <div class="container">
    <div v-if="meet" class="row">
      <div class="col">
          <h1><b>Title:</b> {{meet.title}}</h1>
          <h2><b>Description:</b> {{meet.description}}</h2>
          <h3><b>Початок:</b> {{meet.beginning_date}}</h3>
          <h3><b>Закінчення:</b> {{meet.end_date}}</h3>
          <h4><b>Координати:</b> {{meet.map_point}}</h4>
          <h4><b>Засновник зустрічі:</b> {{meet.user.name}}</h4>
          <h4><b>Належить до клубу:</b> {{meet.club.name}}</h4>
      </div>
    </div>
    <div v-else class="row">
      <div class="col">Loading...</div>
    </div>
  </div>
</template>

<script>
  import { MEET_QUERY } from '../constants/graphql'
  export default {
    name: 'ShowMeet',
    apollo: {
      // Simple query that will update the 'hello' vue property
      meet: {
          query:  MEET_QUERY,
          variables() {
              return {
                  id: this.$route.params.meet_id,
              }
          }
      }
    }
  }
</script>