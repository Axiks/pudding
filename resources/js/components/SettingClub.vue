<template>
    <div class="container">
            <div class="row">
                <div class="col">
                    <img :src="'/storage/' + club.cover_src" class="img-fluid" style="object-fit: cover; height: 450px; width: 100%; filter: blur(0px);">
                    <img :src="'/storage/' + club.avatar_src" class="card-img-top" style="height: 200px; width: 200px; border-radius: 50%; object-fit: cover; border: 3px solid #ffffff; position: absolute; left: 50px; top: 200px; ">
                </div>
            </div>
            <h1>Setting</h1>
            <div class="row">
                <div class="col">
                    <h3>Зміна аватарки</h3>
                    <upload-files :id="id"></upload-files>
                    <h3>Зміна обкладинки</h3>
                    <upload-cover :id="id"></upload-cover>
                    <h3>Видалення аватарки</h3>
                    <destroy-avatar-club :id="club.id"></destroy-avatar-club>
                    <h3>Видалення клубу</h3>
                    <button @click="destroyClub()">Destroy club</button>
                    <h3>Зустріч</h3>
                    <create-meet :club_id="id"></create-meet>
                    <show-meets :meets_data="club.meets"></show-meets>
                </div>
            </div>
    </div>
</template>
<script>
import { CLUB_QUERY } from '../constants/graphql'
import { DESTROY_CLUB_MUTATION } from '../constants/graphql'

  export default {
      name: 'ClubQuery',
      data () {
        if(!this.$route.params.id){
            this.$route.params.id = 1
        }
        console.log(this.$route.params.id)
        return{
            club: '',
            id: this.$route.params.id
        }
      },
      apollo: {
        // Simple query that will update the 'hello' vue property
        club: {
            query:  CLUB_QUERY,
            variables() {
                return {
                    id: this.id,
                }
            }
        }
      },
      methods: {
        destroyClub() {
            console.log("Destroy club mutation");
            this.$apollo.mutate({
                mutation: DESTROY_CLUB_MUTATION,
                variables: {
                    id: this.id
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