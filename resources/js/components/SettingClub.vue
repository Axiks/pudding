<template>
    <div class="container">
            <div class="row">
                <div class="col">
                    <img :src="'/storage/' + club.cover_src" class="img-fluid" style="object-fit: cover; height: 450px; width: 100%; filter: blur(0px);">
                    <img :src="'/storage/' + club.avatar_src" class="card-img-top" style="height: 200px; width: 200px; border-radius: 50%; object-fit: cover; border: 3px solid #ffffff; position: absolute; left: 50px; top: 200px; ">
                </div>
            </div>
            <h1>Setting</h1>
            <form>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Avatar</span>
                        </div>
                        <div class="custom-file">
                            <input@change="uploadAvatar" type="file" class="custom-file-input" id="inputGroupFile01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <button @click="destroyAvatar()" class="btn btn-outline-secondary" type="button">Delete</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Cover</span>
                        </div>
                        <div class="custom-file">
                            <input @change="uploadCover" type="file" class="custom-file-input" id="inputGroupFile02">
                            <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button">Delete</button>
                        </div>
                    </div>
                </div>
                <!-- Destroy club -->
                <button @click="destroyClub()" type="button" class="btn btn-outline-danger">Destroy club</button>
                <!-- Setting -->
            </form>
            <form>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Name</label>
                    <input :value="club.name" type="text" ref="ClubName" class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea :value="club.description" ref="ClubDescription" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <button  @click="editClub()" type="button" class="btn btn-primary">Save</button>
            </form>
    </div>
</template>
<script>
import { CLUB_QUERY } from '../constants/graphql'
import { DESTROY_CLUB_MUTATION } from '../constants/graphql'
import { UPLOAD_AVATAR_CLUB_MUTATION } from '../constants/graphql'
import { UPLOAD_COVER_CLUB_MUTATION } from '../constants/graphql'
import { DESTROY_AVATAR_CLUB_MUTATION } from '../constants/graphql'
import { UPDATE_CLUB_MUTATION } from '../constants/graphql'

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
                    id: this.id,
                }
            }
        }
      },
      methods: {
          editClub() {
            console.log("Update club mutation");
            const name = this.$refs.ClubName.value
            const description = this.$refs.ClubDescription.value
            this.$apollo.mutate({
                mutation: UPDATE_CLUB_MUTATION,
                variables: {
                    id: this.id,
                    name: name,
                    description: description,
                }
            })
            .then((response) =>{
                this.$apollo.queries.club.refetch()
            })
            .catch((error) => {
            // This should log the error object but is just printing out the message
                console.log(error);
                this.$apollo.queries.club.refetch()
            })
            //location.reload()
        },
        destroyClub() {
            console.log("Destroy club mutation");
            this.$apollo.mutate({
                mutation: DESTROY_CLUB_MUTATION,
                variables: {
                    id: this.id
                }
            })
            .catch((error) => {
            // This should log the error object but is just printing out the message
            console.log(error);
            })
            this.$router.push({ name: 'me' })
            //location.reload()
        },
        uploadCover ({ target: { files = [] } }) {
            console.log(this.id);
            if (!files.length) {
            return
            }

            this.$apollo
            .mutate({
                mutation:  UPLOAD_COVER_CLUB_MUTATION,
                variables: {
                file: files[0],
                id: this.id,
                },
                context: {
                hasUpload: true
                }
            })
            .then((response) =>{
                console.log("Then work!)");
                this.$apollo.queries.club.refetch()
            })
            .catch((error) => {
                console.log("Error!)");
                this.$apollo.queries.club.refetch()
            // This should log the error object but is just printing out the message
            console.log(error);
            }) 
      },
      uploadAvatar ({ target: { files = [] } }) {
        console.log(this.id);
        if (!files.length) {
          return
        }
        console.log("uload Avatar")
        this.$apollo
          .mutate({
            mutation:  UPLOAD_AVATAR_CLUB_MUTATION,
            variables: {
              file: files[0],
              id: this.id,
            },
            context: {
              hasUpload: true
            }
          })
          .then((response) =>{
            console.log("Then work!)");
            this.$apollo.queries.club.refetch()
          })
          .catch((error) => {
            console.log("Error!)");
            this.$apollo.queries.club.refetch()
          // This should log the error object but is just printing out the message
          console.log(error);
        })  
      },
      destroyAvatar (){
        this.$apollo
          .mutate({
            mutation:  DESTROY_AVATAR_CLUB_MUTATION,
            variables: {
              id: this.id,
            }
          })
          .catch((error) => {
            console.log("Error!)");
            this.$apollo.queries.club.refetch()
            // This should log the error object but is just printing out the message
            console.log(error);
        })
        this.$apollo.queries.club.refetch()
      },
    }
  }
</script>