<template>
<div class="">
    <!--0-->
    <P>Email: {{email_users}}</P>
    <input type="email" v-model="email" id="signup_email" placeholder="Эл. почта">
    <!-- <p>Email is: {{ email }}</p>
    {{Check_email}} -->
    <password-component v-if="Check_email == 'true'" :email="email"></password-component>
    <register-user v-if="Check_email == 'false'" :email="email"></register-user>
</div>
</template>
<style scoped>
</style>
<script>
import gql from 'graphql-tag'
import {  EMAIL_CHECK } from '../../constants/graphql'
import LoginPassComponent from './PasswordLoginComponent.vue';
import RegisterUserComponent from './RegisterUser';
export default {
    data () {
        return{
            email: 'example@gmail.com',
            Check_email: Boolean,
            email_users: ''
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
            console.log('checkEmail work!')
            //this.$apollo.queries.Check_email.refresh()
            if(this.Check_email == "true") {
                this.email_users = "використовується"
                //Вхід компонент
            }
            else{
                this.email_users = "НЕ використовується"
                //Реєстрація компонент
            }
        }
    },
    components:{
        'password-component': LoginPassComponent,
        'register-user': RegisterUserComponent
    }
}
</script>