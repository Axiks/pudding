<template>
    <div class="container-fluid p-0 m-0">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div id="name">{{user.name}}</div>
                </div>
            </div>
            <div class="row" style= "padding-top: 50px;">
                <div class="shadow-sm col block mt-3">
                    <h3>Опис</h3>
                    <h6>{{user.description}}</h6>
                    {{user}}
                </div>
            </div>

        </div>
    </div>
</template>
<script>
import { USER_QUERY } from '../constants/graphql'

  export default {
      name: 'UserQuery',
      data () {
        console.log(this.$route.params.id)
        return{
            user: '',
            id: this.$route.params.id
        }
      },
      apollo: {
        // Simple query that will update the 'hello' vue property
        user: {
            query:  USER_QUERY,
            variables: {
                    id: '1'
            }

        }
      }
  }
</script>
<style scoped>
    #name{
        position: absolute;
        font-size: 24px;
        left: 200px;
        top: 5px;
    }

     #setting{
        position: absolute;
        top: -30px;
        right: 0px;
    }

    .block{
        border-radius: 0.8rem;
        border: 1px solid rgba(0, 0, 0, 0.125);
        padding: 1rem 2rem;
    }
</style>