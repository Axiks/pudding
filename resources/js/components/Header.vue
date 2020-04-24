<template>
     <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Biskvit</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <router-link to="/clubs" class="nav-link">Усі клуби</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/club/create" class="nav-link">Створити Клуб</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/firstPage" class="nav-link">Початкова сторінка</router-link>
                    </li>
                </ul>
            </div>
            <div v-if="me">
              <router-link to="/me" class="nav-link"><b>{{me.name}}</b></router-link>
            </div>
            <div v-else>
              <router-link to="/login" class="nav-link">Увійти</router-link>
            </div>
        </nav>
</template>

<script>
import gql from 'graphql-tag'
import { ME_DATA_QUERY } from '../constants/graphql'
//console.log(Vue.http.headers);
  export default {
      data () {
        return{
            me: []
        }
      },
      apollo: {
        me:{
            query: ME_DATA_QUERY,
          }
      }
  }
</script>