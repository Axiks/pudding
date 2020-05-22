<template>
  <div class="container-fluid p-0 m-0">
    <nav class="nav nav-pills flex-column flex-sm-row">
        <a class="flex-sm-fill text-sm-center nav-link active" href="#">Мої клуби</a>
        <a class="flex-sm-fill text-sm-center nav-link" href="#">Усі клуби</a>
        <router-link to="myclubs">Home</router-link>
    </nav>
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  
}
</script>