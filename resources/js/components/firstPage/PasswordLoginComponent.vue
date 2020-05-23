<template>
<div class="">
    <!-- <h3>Password component</h3> -->
    <!-- <p>Email: {{email}}</p> -->
    <p>Пароль</p>
    <input type="password" id="signup_password" v-model="password" placeholder="Пароль">
    <p><button @click="createClub()">Увійти</button></p>
</div>
</template>
<script>
import VueRouter from 'vue-router'
import gql from 'graphql-tag'
import {  USER_LOGIN } from '../../constants/graphql'
export default {
    props: {email: String,},
    data () {
        return{
            email: this.email,
            password: null,
            access_token: null,
            token_type: null
        }
    },
    methods: {
        createClub () {
        console.log(this.$data)
        // ... you'll implement this in a bit
        const {email, password} = this.$data
        this.$apollo.mutate({
            mutation: USER_LOGIN,    
            variables: {
            email,
            password,
            }
        })
        .then((data) => {
        // Result
            console.log(data.data.login)
            this.token_type = data.data.login.token_type
            this.access_token = data.data.login.access_token
            localStorage.setItem('token',  data.data.login.access_token)
            this.$router.push("me")
            location.reload()
            //console.log('LocalToken: '+ localStorage.getItem('token'))
        })
        .catch((error) => {
          // This should log the error object but is just printing out the message
          console.log(error);
        })
      }
    }
}
</script>
<style scoped>
</style>