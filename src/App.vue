  <template>
  <div id="app">
    <NavBar></NavBar>
    <router-view/>
  </div>
</template>

<script>
  import NavBar from "../src/views/navbar/navbar"
export default {
  name: 'App',
  components: {NavBar},
}
</script>

<style>
#app {
  font-family: "Helvetica Neue",Helvetica,"PingFang SC","Hiragino Sans GB","Microsoft YaHei","微软雅黑",Arial,sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  /*text-align: center;*/
  color: #2c3e50;
  marign:0;
  padding:0;
  background-color: #f8f9fa;
}
  ul{
    list-style-type: none;
  }
</style>
