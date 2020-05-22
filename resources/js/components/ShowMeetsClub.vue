<template>
  <div class="container">
      <div class="meet-list">
        <div v-for="meet in meets_data.meets">
          <div class="meet">
            <router-link :to="{ name: 'meet', params: {id: meet.id} }" class="link" style="text-decoration: none; color: black;">
              <img :src="'/storage/' + meets_data.cover_src" class="cover">
              <div class="club-info">
                <div class="name">{{meet.title}}</div>
                <div class="start">{{meet.beginning_date}}</div>
                <div class="address">{{meet.map_point}}</div>
              </div>
            </router-link>
          </div>
        </div> 
      </div>
  </div>
</template>

<script>
  export default {
      props: ['meets_data'],
      name: 'ClubMeetsList',
  }
</script>
<style scoped>
  .meet-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    margin-top: 25px;
  }

  .meet {
    width: 250px;
    border-radius: 0.5rem;
    margin-bottom: 25px;
    text-decoration: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
  }

  .meet:hover{
    box-shadow: 0 0.425rem 0.25rem rgba(0, 0, 0, 0.075);
  }

  .meet:active{
    box-shadow: 0 0rem 0.25rem rgba(0, 0, 0, 0.075);
  }

  .club-info {
    padding: 1rem;
  }

  .cover{
    width: 100%;
    height: 100px;
    border-radius: 0.5rem;
    object-fit: cover;
  }
</style>