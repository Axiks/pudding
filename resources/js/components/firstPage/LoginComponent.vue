<template>
<div class="">
    <!--0-->
    {{Check_email}}
    <div v-if="Check_email">Email використовується</div>
    <div v-else>
        не використовуються
    </div>
    <input type="email" v-model="email" id="signup_email" placeholder="Эл. почта">
    <p>Email is: {{ email }}</p>
    <button @click="checkEmail">Увійти</button>
</div>
</template>
<style scoped>
</style>
<script>
import gql from 'graphql-tag'
import {  EMAIL_CHECK } from '../../constants/graphql'
export default {
    data () {
        return{
            email: 'example@gmail.com',
            Check_email: null,
        }
    },
    apollo: {
        Check_email:{
            query:  EMAIL_CHECK,    
            variables() {
                return {
                    email: this.email,
                }
            }
        }     
    },
    methods: {
        checkEmail: function(){
            this.$apollo.queries.Check_email.refresh()
        }
    }
}
</script>