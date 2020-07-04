<template>
  <div class="container">
    <form class="needs-validation" novalidate>
      <div class="form-row">
        <div class="col-md-12 mb-3">
          <label for="validationTooltip01">Title meet</label>
          <input v-model="title" type="text" class="form-control" id="validationTooltip01" required>
          <div class="valid-tooltip">
            Looks good!
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-12 mb-3">
          <label for="exampleFormControlTextarea1">Description</label>
          <textarea v-model="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-4 mb-3">
          <label > Start data</label>
          <input v-model="beginning_date" type="date" max="3000-12-31" 
                :min="nowDate" class="form-control">
        </div>
        <div class="col-md-2 mb-3">
          <label >Start time</label>
          <input v-model="beginning_time"  type="time"
              min="06:00" max="23:59" required class="form-control">
        </div>
        <div class="col-md-4 mb-3">
          <label >End data</label>
          <input v-model="end_date" type="date" :min="nowDate"
                max="3000-12-31" class="form-control">
        </div>
        <div class="col-md-2 mb-3">
          <label >End time</label>
          <input v-model="end_time"  type="time"
              min="06:00" max="23:59" required class="form-control">
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-12 mb-3">
          <label for="validationTooltip03">City</label>
          <input type="text" class="form-control" id="validationTooltip03" placeholder="City" required>
          <div class="invalid-tooltip">
            Please provide a valid city.
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-12 mb-3">
          <label for="validationTooltip03">Map</label>
          <map-select @cordinate='oncCordinate'></map-select>
        </div>
      </div>
      <button @click="createMeet()" class="btn btn-primary" type="button">Create</button>
    </form>
  </div>
</template>

<script>
  import moment from 'moment'
  import { CREATE_MEET_MUTATION } from '../constants/graphql'
  export default {
    props: ['club_id'],
    name: 'CreateMeet',
    computed : {
      years () {
        //const year = new Date().getFullYear()
        const year = 2010
        return Array.from({length: year - 1900}, (value, index) => year - index)
      },
      nowDate: function () {
        return moment().format('YYYY-MM-DD');
      },
    },
    data () {
      return {
        title: null,
        description: null,
        //beginning_date: '2019-09-20 10:00:00',
        //end_date: '2019-09-22 16:00:00',
        beginning_date: null,
        beginning_time: null,
        end_date: null,
        end_time: null,
        map_point: null,
        user_id: 1,
      }
    },
    methods: {
      createMeet () {
        console.log(this.club_id)
        console.log(this.$data)
        // ... you'll implement this in a bit
        this.$data.beginning_date = moment(this.beginning_date + " " + this.beginning_time).format('YYYY-MM-DD HH:mm:ss');
        this.$data.end_date = moment(this.end_date + " " + this.end_time).format('YYYY-MM-DD HH:mm:ss');
        const { title, description, beginning_date, end_date, map_point, club_id, user_id } = this.$data
        this.$apollo.mutate({
            mutation: CREATE_MEET_MUTATION,
            variables: {
            title,
            description,
            beginning_date,
            end_date,
            map_point,
            club_id: this.club_id,
            user_id,
            }
        })
        .catch((error) => {
          // This should log the error object but is just printing out the message
          console.log(error);
        })
      },
      oncCordinate(data){
        console.log('cord: ', data['markers'][0])
        var coordinate = data['markers'][0]
        this.map_point = coordinate['lat'] + ', ' +  coordinate['lng']
      }
    }
  }
</script>