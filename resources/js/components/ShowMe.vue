<template>
    <div class="container-fluid p-0 m-0">
    

    <div>
        <div class="container" style="padding-top: 64px;">
            <div class="row">
                <div class="col-md-12">
                    <img class="img-fluid border rounded-circle d-flex float-left flex-fill mx-auto justify-content-xl-center align-items-xl-center" :src="'/storage/' + me.avatar_src" width="220px">
                    <h3 class="text-center" style="padding: 16px;">{{me.name}} {{me.surname}}</h3>
                </div>
            </div>
            <div v-if="me.description" class="row" style="padding: 12px;">
                <div class="col-md-12">
                    <h1>Про себе</h1>
                    <p>
                        {{me.description}}
                    </p>
                </div>
            </div>
            <div v-if="me.clubs" class="row mt-3">
                <div class="col-md-12">
                    <h1>Учасник Клубів</h1>
                    <div>
                        <ul class="list-group">
                            <li v-for="item in me.clubs" :key="item.id" class="mt-2">
                                <img class="border rounded float-left" :src="'/storage/' + item.avatar_src" width="80px">
                                <router-link :to="{ name: 'club', params: {id: item.id} }" style="text-decoration: none;">
                                    <h5 class="float-left" style="padding-left: 10px;">{{ item.name }}</h5>
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div v-if="me.meets" class="row mt-3" style="padding-top: 12px;">
                <div class="col-md-12">
                    <h1>Зустрічі учасника</h1>
                    <div>
                        <ul class="list-group">
                            <li v-for="item in me.meets" :key="item.id" class="mt-2">
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
</template>
<script>
import gql from 'graphql-tag'
import { ME_DATA_QUERY } from '../constants/graphql'
//console.log(Vue.http.headers);
  export default {
      data () {
        console.log(this.$route.params.id)
        return{
            me: [],
        }
      },
      apollo: {
        // Simple query that will update the 'hello' vue property
        me:{
            query: ME_DATA_QUERY,
      // Static parameters
    
    variables() {
        return {
            
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