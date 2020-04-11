<template>
  <div class="container">
    <loading :active="$apollo.loading"
        :can-cancel="false" 
        :is-full-page="false"
        ></loading>
        <h1>All Clubs</h1>
      <div class="card-deck justify-content-md-center">
        <div v-for="club in clubs">
            <div class="card" style="width: 18rem; margin-bottom: 25px;">
            <img :src="'/storage/' + club.avatar_src" class="card-img-top" style="height: 200px; object-fit: cover;">
            <div class="card-body">
              <router-link :to="{ name: 'club', params: {id: club.id} }" style="text-decoration: none;">
                <h5 class="card-title">{{ club.name }}</h5>
              </router-link>
                <p class="card-text">{{ club.description.substring(0,32)+"..." }}</p>
            </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
  // Import component
  import Loading from 'vue-loading-overlay';
  // Import stylesheet
  import 'vue-loading-overlay/dist/vue-loading.css';
  import { ALL_CLUBS_QUERY } from '../constants/graphql'
  export default {
      name: 'ClubsList',
      data () {
        return{
            id: '',
            name: '',
            description: '',
            avatar_src: '',
            cover_src: '',
        }
      },
      apollo: {
        // Simple query that will update the 'hello' vue property
        clubs: ALL_CLUBS_QUERY,
      },
      components: {
          Loading
      }
  }
</script>