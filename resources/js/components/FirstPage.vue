<template>
    <div class="container-fluid">
    <section class="row no-gutter align-items-center">
        <div class="col-12 text-center p-0 d-flex align-items-center">
            <img :src="'/storage/' + club.cover_src" class="img-fluid position-relative mx-auto" style="height: 100%; width: 100%;">
            <div class="dashboard w-100 position-absolute my-auto">
                        <h1>Biskvit</h1>
                        <h2>Знайди своє захоплення</h2>
                <div class="">
                    <transition name="login">
                        <login-box-component v-if="loginSwitch" style="margin-top: 35px"></login-box-component>
                    </transition>
                    <a href="/#/registration" rel="noopener noreferrer">
                        <button id="registration">
                            <span>Реєстрація</span>
                        </button>
                    </a>
                    <!-- <a href="/#/login">
                        <button id="login">
                            <span>Вхід</span>
                        </button>
                    </a> -->
                    <button v-if="!loginSwitch" id="login" @click="loginFunc()">Вхід</button>
                </div>
            </div>
            <div class="posted_img">
                <a v-bind:href="'#/club/'+id" target="_blank" :rel="club.name">
                    Опублікував <strong>{{club.name}}</strong>
                </a>
                <a v-bind:href="'#/club/'+id" target="_blank" :rel="club.name">
                    <img :src="'/storage/' + club.avatar_src" id="club_avatar" alt="Club avatar" style="height: 50px; width: 50px; border-radius: 50%; object-fit: cover; ">
                </a>
            </div>
        </div>
    </section>
    </div>
</template>

<script>
import { CLUB_QUERY } from '../constants/graphql'
import { ALL_CLUBS_QUERY } from '../constants/graphql'
import LoginPageBoxComponent from './firstPage/LoginPageBoxComponent.vue';

  export default {
      name: 'ClubQuery',
      data () {
        return{
            club: [],
            clubs: [],
            // id: Math.floor(Math.random() * 16 + 1)
            id: 16,
            loginSwitch: false
        }
      },
      apollo: {
        club: {
            query:  CLUB_QUERY,
            variables() {
                return {
                    id: this.id,
                }
            }
        },
        clubs: {
            query:  ALL_CLUBS_QUERY,
            variables() {
                return {
                }
            }
        }
      },
    methods: {
        loginFunc: function(){
            this.loginSwitch = true
        },
        randomClub: function(){
            var clubsCount = this.clubs.length;
            console.log("Clubs lenght: " + clubsCount);
            return 16;
        }
    },
    components:{
        'login-box-component': LoginPageBoxComponent,
    }
  }
</script>

<style scoped>
html, body{
    font-family: Arial;
    font-style: normal;
}
h1{
    font-weight: bold;
    color: #ffffff;
    font-size: 50px;
    line-height: 70px;
}
h2{
    font-size: 16px;
    color: #ffffff;
}
#registration, #login{
    margin: 15px 10px;
    width: 280px;
    height: 45px;
    border-radius: 5px;
    font-family: Arial;
    font-style: normal;
    font-weight: bold;
    font-size: 16px;
    border: 0;
}
#registration{
    background: #ffffff;
    color: black;

}
#login{
    background: #3A55B4;
    color: white;
}
#user_avatar{
    width: 24px;
    height: 24px;
    border-radius: 2px;
    margin: 0 0 0 10px;
}
.align-items-start{
    background: #ffef0b;
}
.posted_img{
    position: absolute;
    bottom: 0;
    right: 0;
    padding: 0 12px;
    margin: 0 0 12px 0;
}
.posted_img a{
    color: #ffffff;
    text-decoration: none;
    font-family: Arial;
    font-style: normal;
    font-size: 14px;
}
.posted_img a strong{
    font-weight: 800;
}
.posted_img a:visited{
        color: #ffffff;
}
</style>