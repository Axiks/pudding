<template>
  <div class="container">
    <!-- 2 -->
    <form class="pt-3">
      <div class="form-group">
        <label for="inputName">Ім'я</label>
        <input v-bind:class="{ 'is-invalid': emppy_name }" v-model="name" type="text" class="form-control" id="inputName">
        <div class="invalid-feedback">
            Fill in the field
        </div>
      </div>
      <div class="form-group">
        <label for="inputSurname">Прізвище</label>
        <input v-bind:class="{ 'is-invalid': emppy_surname }" v-model="surname" type="text" class="form-control" id="inputSurname">
        <div class="invalid-feedback">
            Fill in the field
        </div>
      </div>
      <div class="form-group">
        <label for="inputSurname">Email</label>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
          </div>
          <input v-bind:class="{ 'is-invalid': emppy_email || email_is_used || email_is_bad}" v-model="email" type="email" class="form-control" placeholder="example@gmail.com" aria-label="Email" aria-describedby="basic-addon1">
          <div v-if="emppy_email == true" class="invalid-feedback">
              Fill in the field
          </div>
          <div v-else-if="email_is_used == true" class="invalid-feedback">
              Email is used. Choose another
          </div>
          <div v-else-if="email_is_bad == true" class="invalid-feedback">
              Check that the email is correct
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword6">Password</label>
        <input v-bind:class="{ 'is-invalid': empty_password }" v-model="password" type="password" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline">
        <small id="passwordHelpInline" class="text-muted">
          Must be 8-20 characters long.
        </small>
        <div class="invalid-feedback">
            Fill in the field
        </div>
      </div>
      <div class="form-group">
        <label for="inputRepeatPassword">Repeat password</label>
        <input v-bind:class="{ 'is-invalid': password_not_match }" v-model="password_confirmation" type="password" id="inputRepeatPassword" class="form-control" aria-describedby="passwordHelpInline">
        <div class="invalid-feedback">
            Паролі не збігаються
        </div>
      </div>
      <div class="form-group">
        <label for="exampleFormControlSelect1">Рік народження</label>
        <select v-bind:class="{ 'is-invalid': empty_birthday }" v-model="birthday" class="form-control" id="exampleFormControlSelect1">
          <option v-for="year in years" :value="year">{{year}}</option>
        </select>
        <div class="invalid-feedback">
            Select a year
        </div>
      </div>
      <button @click="checking_create_club()" class="btn btn-primary" type="button">Реєстрація</button>
    </form>
  </div>
</template>

<script>
  import moment from 'moment'
  import { CREATE_USER_MUTATION } from '../../constants/graphql'
  import {  EMAIL_CHECK } from '../../constants/graphql'
  import {  USER_LOGIN } from '../../constants/graphql'
  export default {
    computed : {
      years () {
        //const year = new Date().getFullYear()
        const year = 2010
        return Array.from({length: year - 1900}, (value, index) => year - index)
      }
    },
    data () {
      return {
        name: null,
        surname: null,
        email: null,
        password: null,
        password_confirmation: null,
        birthday: null,
        error: false,
        emppy_name: false,
        emppy_surname: false,
        emppy_email: false,
        empty_password: false,
        empty_birthday: false,
        email_is_used: false,
        email_is_bad: false,
        password_not_match: false,
      }
    },
    methods: {
      login: function() {
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
          this.error = true;
          console.log(error);
        })
      },
      createClub () {
        console.log(this.$data)

        // ... you'll implement this in a bit
        this.$data.birthday = moment('1 Oct ' + this.birthday).format('YYYY-MM-DD');
        const { name, surname, email, password, password_confirmation, birthday} = this.$data
        this.$apollo.mutate({
            mutation: CREATE_USER_MUTATION,
            variables: {
            name,
            surname,
            email,
            password,
            password_confirmation,
            birthday
            }
        })
        .then((data) => {
          // Result
              console.log(data.data)
              this.email_is_bad = false;
              //this.$router.push("firstPage")
              //location.reload()
              //console.log(data.data.register.tokens)
              this.login();
              
          })
        .catch((error) => {
          // This should log the error object but is just printing out the message
          console.log("GraphQ Erorr" + error.message);
          if(error.message == "GraphQL error: Validation failed for the field [register]."){
            console.log("Yess reg error");
            this.email_is_bad = true;
          }
          else{
            console.log("False reg error");
            this.email_is_bad = false;
          }
        })
        
      },
      Check_email() {
      const {email} = this.$data
       this.$apollo.query({
          query:  EMAIL_CHECK,    
          variables: {
            email
          }
        }).then((data) => {
          // Result
              console.log(data.data.Check_email)
              if(data.data.Check_email == "true"){
                this.email_is_used = true;
              }
              else{
                this.email_is_used = false;
                this.createClub ();
              }
              console.log("This email used: " + this.email_is_used)
          })
          .catch((error) => {
            // This should log the error object but is just printing out the message
            console.log(error);
          })
      },
      checking_create_club(){
        //Email check
        if(this.email == null || this.email.length <=0){
          this.emppy_email = true;
        }
        else{
          this.emppy_email = false
        }
        if(this.field_checking() && !this.emppy_email){
          this.Check_email()
        }
      },
      field_checking () {
        //Name
        var check = true;
        if(this.name == null){
          this.emppy_name = true;
          check = false;
        }
        else{
          this.emppy_name = false
        }

        //Surname
        if(this.surname == null){
          this.emppy_surname = true;
          check = false;
        }
        else{
          this.emppy_surname = false
        }

        //Password
        if(this.password != null && this.password.length >= 8){
          this.empty_password = false
        }
        else{
          this.empty_password = true;
          check = false;
        }

        //Birthday
        if(this.birthday == null){
          this.empty_birthday= true;
          check = false;
        }
        else{
          this.empty_birthday = false
        }

        //Password match
        if(this.password == this.password_confirmation){
          this.password_not_match = false
        }
        else{
          this.password_not_match = true;
          check = false;
        }
        return check;
      }
    },
  }
</script>