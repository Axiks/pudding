/* Dont All Works */
<template>
  <div class="container-fluid p-0 m-0">

<div class="carousel slide" data-ride="carousel" id="carousel-1">
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active"><img class="img-fluid w-100 d-block" :src="'/storage/' + meet.club.cover_src" alt="Slide Image" style="object-fit: cover; height: 450px; width: 100%; filter: blur(0px);"></div>
            <!-- <div class="carousel-item"><img class="w-100 d-block" src="https://cdn.bootstrapstudio.io/placeholders/1400x800.png" alt="Slide Image"></div>
            <div class="carousel-item"><img class="w-100 d-block" src="https://cdn.bootstrapstudio.io/placeholders/1400x800.png" alt="Slide Image"></div> -->
        </div>
        <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev"><span class="carousel-control-prev-icon"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button" data-slide="next"><span class="carousel-control-next-icon"></span><span class="sr-only">Next</span></a></div>
        <ol
            class="carousel-indicators">
            <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-1" data-slide-to="1"></li>
            <li data-target="#carousel-1" data-slide-to="2"></li>
            </ol>
    </div>
    <div>
        <div class="container">
          <div class="row">
                <div v-if="me" class="col-md-12">
                  <button  v-if="!member" @click="addMeetUser(meet.id)" class="btn btn-primary float-right" type="button" style="margin: 10px;">Відвідаю</button>
                  <button  v-if="member" @click="deleteMeetUser(meet.id)" class="btn btn-primary float-right" type="button" style="margin: 10px;background-color: rgb(218,87,103);">Не прийду</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center" style="padding: 16px;">{{meet.title}}</h3>
                    <img :src="'/storage/' + meet.club.avatar_src" class="card-img-top img-fluid border rounded-circle d-flex flex-fill mx-auto justify-content-xl-center align-items-xl-center" style="height: 120px; width: 120px; border-radius: 50%; object-fit: cover; border: 3px solid #ffffff; ">
                  </div>
                    
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h1>Опис</h1>
                    <p>
                      {{meet.description}}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h1>Учасники</h1>
                        <ul class="list-group">
                          <li v-for="user in meet.users" :key="user.id" class="list-group-item">
                              <img v-if="user.avatar_src" class="border rounded float-left" :src="'/storage/' + user.avatar_src" width="80px">
                              <router-link :to="{ name: 'user', params: {id: user.id} }" style="text-decoration: none;">
                                <h5 class="float-left" style="padding-left: 10px;">{{user.name}}</h5>
                              </router-link>
                          </li>

                        </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h1>Інформація</h1>
                    <p><strong>Початок: {{meet.beginning_date}}</strong><br>Кінець: {{meet.end_date}}<br>Місцерозташування: {{meet.map_point}}</p>
                    <div>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div>
                                    <img :src="'/storage/' + meet.club.avatar_src" class="card-img-top float-left" style="height: 80px; width: 80px; border-radius: 50%; object-fit: cover; border: 3px solid #ffffff; ">
                                    <router-link :to="{ name: 'club', params: {id: meet.club.id} }" style="text-decoration: none;">
                                      <h5 class="float-left" style="padding-left: 10px;">{{meet.club.name}}</h5>
                                    </router-link>
                                </div>
                                <div>
                                    <router-link :to="{ name: 'user', params: {id: meet.user.id} }" style="text-decoration: none;">
                                      <p class="float-right">{{meet.user.name}}</p>
                                    </router-link>
                                    <img class="border rounded float-right" :src="'/storage/' + meet.user.avatar_src" width="50px" style="margin-right: 12px;">
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h1>Map</h1>
                    <map-view v-bind:post-cordinate="map_obj"></map-view>
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
  import { MEET_QUERY } from '../constants/graphql'
  import { ADD_USER_MEET_MUTATION } from '../constants/graphql'
  import { DELETE_USER_MEET_MUTATION } from '../constants/graphql'
  import {  ME_DATA_QUERY } from '../constants/graphql'
  import { latLng } from "leaflet";
  export default {
    name: 'ShowMeet',
    data () {
        return{
            meet: '',
            me: null,
            id: this.$route.params.id,
        }
    },
    apollo: {
      // Simple query that will update the 'hello' vue property
      someQuery: {
        query: MEET_QUERY,
        fetchPolicy: 'no-cache'
      },
      meet: {
          query:  MEET_QUERY,
          variables() {
              return {
                  id: this.$route.params.id,
              }
          }
      },
      me: {
          query:  ME_DATA_QUERY
      }
    },
    methods: {
        addMeetUser: function(id) {
          console.log("Btn press. ID" + id);
          location.reload()
          this.$apollo
            .mutate({
              mutation: ADD_USER_MEET_MUTATION,
              variables: {
                meet_id: id,
            },
          })
        },
        deleteMeetUser: function(id) {
          console.log("Btn press delete. ID" + id);
          location.reload()
          this.$apollo
            .mutate({
              mutation: DELETE_USER_MEET_MUTATION,
              variables: {
                meet_id: id,
            },
          })
        }
      },
      computed: {
        // геттер вычисляемого значения
        member: function () {
          // `this` указывает на экземпляр vmvar user_id = 1;
          if(this.meet.users.length > 0){
            for (var i = 0; i < this.meet.users.length; i++) {
              console.log(this.meet.users[i].id);
              if (this.meet.users[i].id == this.me.id + "") {
                  console.log("text find");
                  return true;
                }
            }
          }
          
          return false;
        },
        map_obj: function () {
          var coordinatParse = this.meet.map_point.split(',')
          var map = latLng(coordinatParse[0], coordinatParse[1])
          return map
        }
    }
  }
</script>

<style scoped>

</style>