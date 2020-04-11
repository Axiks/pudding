<template>
    <div class="container-fluid p-0 m-0">
         <img :src="'/storage/' + club.cover_src" class="img-fluid" style="object-fit: cover; height: 450px; width: 100%; filter: blur(0px);">
        <div class="container">
            <div class="row">
                <div class="col">
                    <img :src="'/storage/' + club.avatar_src" class="card-img-top" style="height: 200px; width: 200px; border-radius: 50%; object-fit: cover; border: 3px solid #ffffff; position: absolute; left: 0px; top: -150px; ">
                    <div id="name">{{club.name}}</div>
                    <router-link id="setting" :to="{ name: 'settingClub' }">Налаштування</router-link>
                </div>
            </div>
            <div class="row" style= "padding-top: 50px;">
                <div class="shadow-sm col block mt-3">
                    <h3>Опис</h3>
                    <h6>{{club.description}}</h6>
                </div>
            </div>
            <div v-if="club.meets.length != 0">
                <div class="row" style= "margin-bottom: 50px;">
                    <div class="shadow-sm col block mt-3">
                            <h3>Зустрічі</h3>
                            <show-meets :meets_data="club"></show-meets>
                    </div>
                </div>
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
      }
  }
</script>
<style scoped>
    #name{
        position: absolute;
        font-size: 24px;
        left: 200px;
        top: 5px;
    }

     #setting{
        position: absolute;
        top: -30px;
        right: 0px;
    }

    .block{
        border-radius: 0.8rem;
        border: 1px solid rgba(0, 0, 0, 0.125);
        padding: 1rem 2rem;
    }
</style>