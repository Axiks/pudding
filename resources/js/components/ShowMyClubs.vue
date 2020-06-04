<template>
  <div class="container">
    <div v-if="me.clubs.lenght > 0">
      <h1>My Clubs</h1>
      <div class="card-deck justify-content-md-center">
        <div v-for="club in me.clubs">
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
    <loading :active="$apollo.loading"
        :can-cancel="false" 
        :is-full-page="false"
        ></loading>
  </div>
</template>

<script>
  // Import component
  import Loading from 'vue-loading-overlay';
  // Import stylesheet
  import 'vue-loading-overlay/dist/vue-loading.css';
  import { ME_DATA_QUERY } from '../constants/graphql'
  export default {
      name: 'ClubsList',
      data () {
        return{
            id: '',
            name: '',
            description: '',
            avatar_src: '',
        }
      },
      apollo: {
        // Simple query that will update the 'hello' vue property
        me: ME_DATA_QUERY,
      },
      components: {
          Loading
      }
  }
</script>