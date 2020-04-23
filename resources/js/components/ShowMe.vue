<template>
    <div class="container-fluid p-0 m-0">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div id="name">{{me.name}}</div>
                </div>
            </div>
            <div class="row" style= "padding-top: 50px;">
                <div class="shadow-sm col block mt-3">
                    <h3>Опис</h3>
                    <h6>{{me.description}}</h6>
                    {{me}}
                </div>
            </div>

        </div>
    </div>
</template>
<script>
import gql from 'graphql-tag'
import { ME_DATA_QUERY } from '../constants/graphql'
//console.log(Vue.http.headers);
  export default {
      data () {
        console.log(this.$route.params.id)
        return{
            me: [],
        }
      },
      apollo: {
        // Simple query that will update the 'hello' vue property
        me:{
            query: ME_DATA_QUERY,
      // Static parameters
    
    variables() {
        return {
            
        }
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