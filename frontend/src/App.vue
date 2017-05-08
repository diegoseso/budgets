<template>
    <div id="app">
        <div id="header">
            <router-link to="/home" ><img src="./assets/logo.png" /></router-link>
            <h2 style="left-margin:10px">{{msg}}</h2>
        </div>      
        <hr>
        <ul>
            <li><router-link :to="{name:'create-budget'}">Create Budget</router-link></li>
            <li><router-link to="/budgets">Budgets list</router-link></li>
            <li><router-link to="/help">Help</router-link></li>
        </ul>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
  name: 'app',
  data () {
    return {
      msg: 'Company name here e.j. ( Detodoenpc Asesores, c.a.) '
    }
  }
}
</script>

<style lang="scss">
#header{
    display: inline-flex
},
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
  margin-top: 5px;
}

h1, h2 {
  font-weight: normal;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

a {
  color: #00bcd4;
}
</style>
