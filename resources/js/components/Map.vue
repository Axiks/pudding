<template>
<div class="container">
    <h1>Map</h1>
        <google-map
            :center="{lat:10, lng: 10}"
            :zoom="7"
            style="width: 100%; height: 450px;"
            :options="{
            zoomControl: true,
            mapTypeControl: false,
            scaleControl: false,
            streetViewControl: false,
            rotateControl: false,
            fullscreenControl: true,
            disableDefaultUi: false
            }"
        >
    </google-map>
</div>
</template>
<script>
export default {
    
}
</script>