<template>
  <Nav />
  <router-view/>
</template>
<script>
import Nav from "./components/inc/Nav"
import axios from "axios";
import Auth from "./store";
export default {
name:'App',
  components:{
  Nav
  },
  setup(){
      axios.get("/user").then(res => {
          Auth.authenticated = res.data !== "";
      })
  }
}
</script>
