<template>
    <div class="container-fluid p-0 m-0">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div id="name">Name: {{me.name}}</div>
                    <div id="name">Surname: {{me.surname}}</div>
                </div>
            </div>
            <div class="row" style= "padding-top: 50px;">
                <div class="shadow-sm col block mt-3">
                    <img :src="'/storage/' + me.avatar_src" style="height: 200px; width: 200px; border-radius: 50%; object-fit: cover; border: 3px solid #ffffff;">
                    <h3>Опис</h3>
                    <h6>{{me.description}}</h6>
                    {{me}}
                    <h3>Змінити аватарку</h3>
                    <upload-avatar></upload-avatar>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import gql from 'graphql-tag'
import { ME_DATA_QUERY } from '../../constants/graphql'
import UploadAvatarUserComponent from './UploadAvatar';
//console.log(Vue.http.headers);
  export default {
      data () {
        console.log(this.$route.params.id)
        return{
            me: [],
        }
      },
      apollo: {
        me:{
            query: ME_DATA_QUERY,    
            variables() {
                return {
                    
                    }
            }
        }
      },
        components:{
            'upload-avatar':  UploadAvatarUserComponent
        }
  }
  </script>
