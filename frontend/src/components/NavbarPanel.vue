<template>
  <div class="navbar">
    <a @click="$router.push('/')" class="navbar-title navbar-text" href="#">VueBlog</a>
    <div class="links">
      <a @click="$router.push('/users')" class="navbar-text" href="#">Users</a>
      <span style="margin: 0 10px; color: #f3f3f3;"> | </span>
      <a @click="logout" class="navbar-text" href="#">Logout</a>
    </div>
  </div>
</template>

<script>
import {authLogout} from "@/API/api";

export default {
  methods: {
    async logout() {
      await authLogout()
        .then(response => {
          if (response.status === 200) {
            this.$router.push('/login');
            localStorage.clear();
          }
        })
        .catch(error => {
          console.log(error);
        })
    }
  }
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
  text-decoration: none;
  color: white;
}
.links {
  margin-right: 20px
}
</style>