<template>
<div class="">
    <!--0-->
    <!-- <p v-if="error_email_clear" class="error">Введи Email</p>
    <p v-if="error_email_db" class="error">Такого Email не існує. Зареєструйся</p>
    <p v-if="error_password_small" class="error">Пароль повинен складатися з більше 8 знаків. Повтори спробу</p>
    <p v-if="error" class="error">Email або Password неправильні</p> -->
    <!-- 1 -->
    <form>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input  v-model="email" type="email" class="form-control" v-bind:class="{ 'is-invalid': error || error_email_clear || error_email_db }" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            <div class="invalid-feedback">
            Please choose a email.
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input v-model="password" type="password" class="form-control" v-bind:class="{ 'is-invalid': error || error_password_small }" id="exampleInputPassword1" placeholder="Password">
            <div class="invalid-feedback">
            Please choose a password.
            </div>
        </div>
        <button @click="login()" class="btn btn-primary" type="button">Увійти</button>
    </form>
</div>
</template>
<style scoped>
    .error{
        color: red
    }
</style>
<script>
import gql from 'graphql-tag'
import {  EMAIL_CHECK } from '../../constants/graphql'
import {  USER_LOGIN } from '../../constants/graphql'
import LoginPassComponent from './PasswordLoginComponent.vue';
import RegisterUserComponent from './RegisterUser';
export default {
    data () {
        return{
            email: null,
            Check_email: Boolean,
            email_users: '',
            password: null,
            access_token: null,
            token_type: null,
            error: false,
            error_email_db: false,
            error_email_clear: false,
            error_password_small: false,
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
        login: function() {
        console.log(this.$data)
        //Check Email
        //Input clear?
        if(this.email == null || this.email.length <= 0){
            this.error_email_clear = true;
            return 0;
        }
        else{
            this.error_email_clear = false;
        }
        //Find Email DB
        // if(this.Check_email == false){
        //     this.error_email_db = true;
        //     return 0;
        // }
        // else{
        //     this.error_email_db = false;
        // }
        //Password small
        if(this.password == null || this.password.length <= 0){
            this.error_password_small = true;
            return 0;
        }
        else{
            this.error_password_small = false;
        }
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
          this.error = true;
          console.log(error);
        })
      }
    },
    components:{
        'password-component': LoginPassComponent,
        'register-user': RegisterUserComponent
    }
}
</script>