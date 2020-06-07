<template>
    <div class="container">
        <div class="container">
            <div class="row" style= "padding-top: 50px;">
                <div class="shadow-sm col block mt-3 p-3">
                    <img :src="'/storage/' + me.avatar_src" style="height: 200px; width: 200px; border-radius: 50%; object-fit: cover; border: 3px solid #ffffff;">
                    <!-- {{me}} -->
                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Name</label>
                            <input :value="me.name" type="text" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput2">Surname</label>
                            <input :value="me.surname" type="text" class="form-control" id="exampleFormControlInput2">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">About myself</label>
                            <textarea :value="me.description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                                <label >Birthday</label>
                                <input :value="me.birthday" type="date" :max="nowDate" 
                                        min="1900-1-1" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Email</label>
                            <input :value="me.email" type="email" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Avatar</span>
                                </div>
                                <div class="custom-file">
                                    <input @change="uploadAvatar" type="file" class="custom-file-input" id="inputGroupFile01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <button @click="destroyAvatar()" class="btn btn-outline-secondary" type="button">Delete</button>
                                </div>
                            </div>
                        </div>
                        <button  @click="editUser()" type="button" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import gql from 'graphql-tag'
import moment from 'moment'
import { ME_DATA_QUERY } from '../../constants/graphql'
import { UPLOAD_USER_AVATAR_MUTATION } from '../../constants/graphql'
import { DESTROY_AVATAR_USER_MUTATION } from '../../constants/graphql'
//console.log(Vue.http.headers);
  export default {
      data () {
        console.log(this.$route.params.id)
        return{
            me: [],
        }
      },
      computed : {
        nowDate: function () {
            return moment().format('YYYY-MM-DD');
        },
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
        methods: {
        uploadAvatar ({ target: { files = [] } }) {
            if (!files.length) {
            return
            }

            this.$apollo
            .mutate({
                mutation: UPLOAD_USER_AVATAR_MUTATION,
                variables: {
                    file: files[0]
                },
                context: {
                hasUpload: true
                }
            })
        },
        destroyAvatar (){
            this.$apollo
            .mutate({
                mutation:  DESTROY_AVATAR_USER_MUTATION,
                
            })
            .catch((error) => {
                console.log("Error!)");
                //this.$apollo.queries.club.refetch()
                // This should log the error object but is just printing out the message
                console.log(error);
            })
            //this.$apollo.queries.club.refetch()
      },
     }
  }
  </script>
