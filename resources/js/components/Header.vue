<template>
     <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">
              <img src="/assets/brand/bootstrap-solid.svg" width="30" height="30" alt="">
              Biskvit
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <router-link to="/clubs" class="nav-link">Усі клуби</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/firstPage" class="nav-link">Початкова сторінка</router-link>
                    </li>
                    
                </ul>
            </div>
            <div v-if="me">
              <button @click="logout()" class="nav-link">Вийти</button>
              <router-link to="/club/create" class="btn btn-success mr-3">Створити Клуб</router-link>
              <router-link to="/me" class="nav-link">
                <img v-if="me.avatar_src" :src="'/storage/' + me.avatar_src" style="height: 45px; width: 45px; border-radius: 50%; object-fit: cover; border: 3px solid #ffffff;">
                <b>{{me.name}}</b>
              </router-link>
            </div>
            <div v-else>
              <router-link to="/firstPage" class="nav-link">Увійти</router-link>
            </div>
        </nav> -->

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
              <router-link to="/clubs" class="navbar-brand">
                <img :src="'/storage/default/favicon.png'" class="mr-2" width="45" height="45" alt="">
                <!-- Biskvit -->
              </router-link>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
              <li class="nav-item">
                <router-link to="/clubs" class="nav-link">Усі клуби</router-link>
              </li>
            </ul>
            <form  v-if="me" class="form-inline my-2 my-lg-0">
              <!-- <button @click="logout()" class="btn btn-outline-danger my-2 my-sm-0 ml-3">Вийти</button> -->
              <router-link to="/club/create" class="btn btn-success mr-3 my-2 my-sm-0 ml-3">Створити Клуб</router-link>
              <ul class="navbar-nav">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img v-if="me.avatar_src" :src="'/storage/' + me.avatar_src" class="mr-2" style="height: 45px; width: 45px; border-radius: 50%; object-fit: cover; border: 3px solid #ffffff;">
                    {{me.name}}
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <router-link to="/me" class="dropdown-item">Профіль</router-link>
                    <router-link to="/setting" class="dropdown-item">Налаштування</router-link>
                    <a @click="logout()" class="dropdown-item" href="#">Вийти</a>
                  </div>
                </li>
              </ul>
            </form>
            <form v-else class="form-inline my-2 my-lg-0">
              <router-link to="/firstPage" class="btn btn-primary mr-3 my-2 my-sm-0 ml-3">Увійти</router-link>
            </form>
          </div>
        </nav>
</template>

<script>
import gql from 'graphql-tag'
import { ME_DATA_QUERY } from '../constants/graphql'
import { USER_LOGOUT } from '../constants/graphql'
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
      },
      methods: {
      logout () {
        console.log("LogOut btn press")
        this.$apollo.mutate({
            mutation: USER_LOGOUT
        })
        .catch((error) => {
          console.log(error);
        })
        //location.reload()
        this.$router.push({ name: "firstPage"})
        location.reload()
        // this.$router.push({ name: "clubs"})
      }
    }
  }
</script>