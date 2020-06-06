<template>
  <div class="container">
    <h2>Створити клуб</h2>
    <!-- 2 -->
    <form>
      <div class="form-group">
        <div class="form-row">
          <label for="exampleFormControlInput1">Title</label>
          <input v-model="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
      </div>
      <div class="form-group">
        <div class="form-row">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea v-model="description" ref="ClubDescription" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
      </div>
      <div class="form-group">
        <div class="form-row">
          <div class="col-md-6">
            <label for="exampleFormControlSelect1">Min Age</label>
            <select class="form-control" id="exampleFormControlSelect1">
              <option v-for="n in 88">{{n+11}}</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="exampleFormControlSelect1">Max Age</label>
            <select class="form-control" id="exampleFormControlSelect1">
              <option v-for="n in 87">{{n+12}}</option>
            </select>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="form-row">
          <label for="exampleFormControlSelect2">Tags</label>
          {{selectedTags}}
          <select multiple v-model="selectedTags" class="form-control" id="exampleFormControlSelect2" style="height: 250px">
            <option v-for="item in hobby_lists" :key="item.id ">{{item.name}}</option>
          </select>
        </div>
      </div>
      <button @click="createClub()" type="button" class="btn btn-primary">Create</button>
    </form>
  </div>
</template>

<script>
  import { CREATE_CLUB_MUTATION } from '../constants/graphql'
  import { ME_DATA_QUERY } from '../constants/graphql'
  import { ALL_HOBBY_QUERY } from '../constants/graphql'
  export default {
    name: 'CreateClub',
    data () {
      return {
        me: [],
        hobby_lists: [],
        name: ' ',
        description: ' ',
        selectedTags: null,
        cover_src: 'def',
        creator_id: null
      }
    },
    apollo: {
      // Simple query that will update the 'hello' vue property
      me:{
          query: ME_DATA_QUERY,
      },
      hobby_lists:{
          query: ALL_HOBBY_QUERY,
      }
    },
    methods: {
      createClub () {
        console.log(this.$data)
        // ... you'll implement this in a bit
        this.$data.creator_id = this.me.id + ""
        const { name, description, cover_src, creator_id} = this.$data
        this.$apollo.mutate({
            mutation: CREATE_CLUB_MUTATION,
            variables: {
            name,
            description,
            cover_src,
            creator_id
            }
        })
        .catch((error) => {
          // This should log the error object but is just printing out the message
          console.log(error);
        })
        this.$router.push({ name: "clubs"})
      },
      addTag (){

      }
    }
  }
</script>