<template>
    <div class="container-fluid p-0 m-0">
        <div class="container">

    <div>
        <div class="container" style="padding-top: 64px;">
            <div class="row">
                <div class="col-md-12">
                    <img class="img-fluid border rounded-circle d-flex float-left flex-fill mx-auto justify-content-xl-center align-items-xl-center" :src="'/storage/' + user.avatar_src" width="220px">
                    <h3 class="text-center" style="padding: 16px;">{{user.name}} {{user.surname}}</h3>
                </div>
            </div>
            <div v-if="user.description" class="row" style="padding: 12px;">
                <div class="col-md-12">
                    <h1>Про себе</h1>
                    <p>
                        {{user.description}}
                    </p>
                </div>
            </div>
            <div v-if="user.clubs" class="row mt-3">
                <div class="col-md-12">
                    <h1>Учасник Клубів</h1>
                    <div>
                        <ul class="list-group">
                            <li v-for="item in user.clubs" :key="item.id" class="mt-2">
                                <img class="border rounded float-left" :src="'/storage/' + item.avatar_src" width="80px">
                                <router-link :to="{ name: 'club', params: {id: item.id} }" style="text-decoration: none;">
                                    <h5 class="float-left" style="padding-left: 10px;">{{ item.name }}</h5>
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div v-if="user.meets" class="row mt-3" style="padding-top: 12px;">
                <div class="col-md-12">
                    <h1>Зустрічі учасника</h1>
                    <div>
                        <ul class="list-group">
                            <li v-for="item in user.meets" :key="item.id" class="mt-2">
                                <img class="border rounded float-left" :src="'/storage/' + item.club.avatar_src" width="80px">
                                <router-link :to="{ name: 'meet', params: {id: item.id} }" style="text-decoration: none;">
                                    <h5 class="float-left" style="padding-left: 10px;">{{ item.title }}</h5>
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="padding-bottom: 100px;"></div>
            </div>
        </div>
    </div>

        </div>
    </div>
</template>
<script>
import gql from 'graphql-tag'
import { USER_QUERY } from '../constants/graphql'

  export default {
      name: 'UserQuery',
      data () {
        console.log(this.$route.params.id)
        return{
            user: [],
        }
      },
      apollo: {
        // Simple query that will update the 'hello' vue property
        user:{
            query: USER_QUERY,
      // Static parameters
    
    variables() {
        return {
            id: this.$route.params.id,
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