<template>
  <div class="container">
     <app-top></app-top>
     <div class="block-form">

     </div>
    <app-bottom></app-bottom>

  </div>


</template>

<script>
import AppTop from "./components/AppTop";
import AppBottom from "./components/AppBottom";
export default {
  name: 'App',

  components: {
      AppTop,AppBottom
  }
}
</script>
<style>
  .container{
    max-width: 1410px;
    margin: 0 auto;
  }
    .top-block{

    }
</style>

