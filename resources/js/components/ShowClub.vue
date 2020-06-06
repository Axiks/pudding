<template>
    <div class="container-fluid p-0 m-0">
        <img :src="'/storage/' + club.cover_src" class="img-fluid" style="object-fit: cover; height: 450px; width: 100%; filter: blur(0px);">
        <div class="container">
            <div v-if="me" class="col-md-12">
                  <button  v-if="!member" @click="addClubUser(club.id)" class="btn btn-primary float-right" type="button" style="margin: 10px;">Стати учасником</button>
                  <button  v-if="member" @click="deleteClubUser(club.id)" class="btn btn-primary float-right" type="button" style="margin: 10px;background-color: rgb(218,87,103);">Покинути</button>
                  <router-link v-if="checkAdmin" :to="{ name: 'settingClub' }" class="btn btn-light float-right" type="button" style="margin: 10px;">Налаштування</router-link>
                  <router-link v-if="checkAdmin" :to="{ name: 'createMeet' }" class="btn btn-primary float-right" type="button" style="margin: 10px;">Створити зустріч</router-link>
            </div>
            <div class="row">
                <div class="col">
                    <img :src="'/storage/' + club.avatar_src" class="card-img-top" style="height: 200px; width: 200px; border-radius: 50%; object-fit: cover; border: 3px solid #ffffff; position: absolute; left: 0px; top: -150px; ">
                    <div id="name">{{club.name}}</div>
                    <!-- <router-link id="setting" :to="{ name: 'settingClub' }">Налаштування</router-link> -->
                </div>
            </div>
            <div class="row" style= "padding-top: 50px;">
                <div class="shadow-sm col block mt-3">
                    <h3>Опис</h3>
                    <h6>{{club.description}}</h6>
                </div>
            </div>
            <div v-if="club.hobbyes.length != 0" class="row" style= "margin-bottom: 50px;">
                <div class="shadow-sm col block mt-3">
                    <h3>Теги</h3>
                    <ul id="example-1">
                        <li v-for="item in club.hobbyes" :key="item.id">
                            {{ item.name }}
                        </li>
                    </ul>
                </div>
            </div>
            <div v-if="club.users.length != 0" class="row" style= "margin-bottom: 50px;">
                <div class="shadow-sm col block mt-3">
                    <h3>Учасники</h3>
                    <ul id="example-2">
                        <li v-for="item in club.users" :key="item.id">
                            <router-link :to="{ name: 'user', params: {id: item.id} }" style="text-decoration: none;">{{ item.name }}</router-link>
                        </li>
                    </ul>
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
            <!-- <create-meet :club_id="id"></create-meet> -->
            <div class="row" style= "margin-bottom: 50px;">
                <div class="shadow-sm col block mt-3">
                    <h3>Засновник</h3>
                    <router-link :to="{ name: 'user', params: {id: club.creator.id} }" style="text-decoration: none;">{{club.creator.name}}</router-link>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { CLUB_QUERY } from '../constants/graphql'
import { DESTROY_CLUB_MUTATION } from '../constants/graphql'
import { ADD_USER_CLUB_MUTATION } from '../constants/graphql'
import { DELETE_USER_CLUB_MUTATION } from '../constants/graphql'
import {  ME_DATA_QUERY } from '../constants/graphql'

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
                    id: this.id.slice(),
                }
            }
        },
        me: {
            query:  ME_DATA_QUERY
        }
      },
    methods: {
        addClubUser: function(id) {
        console.log("Btn press. ID" + id);
        location.reload()
        this.$apollo
            .mutate({
            mutation: ADD_USER_CLUB_MUTATION,
            variables: {
                club_id: id,
            },
        })
        },
        deleteClubUser: function(id) {
            console.log("Btn press delete. ID" + id);
            location.reload()
            this.$apollo
            .mutate({
            mutation: DELETE_USER_CLUB_MUTATION,
            variables: {
                club_id: id,
            },
        })
        }
    },
    computed: {
        // геттер вычисляемого значения
        member: function () {
          // `this` указывает на экземпляр vmvar user_id = 1;
          for (var i = 0; i < this.club.users.length; i++) {
            if (this.club.users[i].id == this.me.id) {
                console.log("text find");
                return true;
              }
          }
          return false;
        },
        checkAdmin: function () {
          // `this` указывает на экземпляр vmvar user_id = 1;
            if (this.club.creator.id == this.me.id) {
                return true;
              }
          return false;
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