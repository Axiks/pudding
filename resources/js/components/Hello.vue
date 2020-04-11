<template>
<div>
    <div class="alert alert-primary" role="alert">
        {{ message }}
    </div>
    <input type="text" v-model="message">
</div>
</template>

<script>
export default {
    name: 'app',
    data() {
        return{
            message: 'Hello World!!!',
        }
    },
}
</script>