<template>
  <div class="component">
    <div class="flex flex-column mt3">
    <h2>Реєстрація</h2>
      <p>Ім'я</p><input
        class="mb2"
        v-model="name"
        type="text">
      <p>Прізвище</p><input
        class="mb2"
        v-model="surname"
        type="text">
      <p>email</p><input
        class="mb2"
        v-model="email"
        type="text">
      <p>Пароль</p><input
        class="mb2"
        v-model="password"
        type="text">
      <p>Повтори пароль</p><input
        class="mb2"
        v-model="password_confirmation"
        type="text">
      <p>Вкажи вік</p><input
        class="mb2"
        v-model="age"
        type="text">
    </div>
    <button @click="createClub()">Реєстрація</button>
  </div>
</template>

<script>
  import { CREATE_USER_MUTATION } from '../constants/graphql'
  export default {
    name: 'CreateUser',
    data () {
      return {
        name: '',
        surname: '',
        email: '',
        password: '',
        password_confirmation: '',
        birthday: '1992-08-24'
      }
    },
    methods: {
      createClub () {
        console.log(this.$data)
        // ... you'll implement this in a bit
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
        .catch((error) => {
          // This should log the error object but is just printing out the message
          console.log(error);
        })
      }
    }
  }
</script>