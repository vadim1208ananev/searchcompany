<template>
  <div class="container">
     <app-top></app-top>
     <div class="block-form">
         <div class="block-notify">
             <div class="top-notify"></div>
             <div class="bottom-notify"></div>
         </div>
         <div class="own-form">
             <input
                     type="text"
                     v-model="finder"
                     placeholder="Enter your desired company name"
                     @keydown.enter="SendMessage"
             >
             <button type="button">Ckeck Now</button>
         </div>
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

