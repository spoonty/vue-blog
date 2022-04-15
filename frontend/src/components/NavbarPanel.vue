<template>
  <div class="navbar">
    <a class="navbar-title navbar-text" href="#">Navbar</a>
    <div class="links">
      <a class="navbar-text" href="#">Users</a>
      <span style="margin: 0 10px; color: #f3f3f3;"> | </span>
      <a class="navbar-text" href="#">Logout</a>
    </div>
  </div>
</template>

<script>
export default {

}
</script>

<style scoped>
.navbar {
  width: 100%;
  height: 50px;
  background-color: #00c0c0;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.navbar-title {
  font-size: 30px;
  font-weight: bold;
  margin-left: 20px;
}
.navbar-text {
  font-family: Tahoma;
  text-decoration: none;
  color: white;
}
.links {
  margin-right: 20px
}
</style>