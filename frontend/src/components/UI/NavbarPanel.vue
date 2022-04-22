<template>
  <div class="navbar">
    <a @click="$router.push('/')" class="navbar-title navbar-text" href="#">VueBlog</a>
    <div class="links" v-if="getIsAuth">
      <a @click="$router.push('/users')" class="navbar-text" href="#">Users</a>
      <span style="margin: 0 10px; color: #f3f3f3;"> | </span>
      <a @click="logout" class="navbar-text" href="#">Logout</a>
    </div>

    <div class="links" v-else>
      <a @click="$router.push('/register')" class="navbar-text" href="#">Register</a>
      <span style="margin: 0 10px; color: #f3f3f3;"> | </span>
      <a @click="$router.push('/login')" class="navbar-text" href="#">Login</a>
    </div>
  </div>
</template>

<script>
import {mapGetters, mapActions} from "vuex";

export default {
  methods: {
    ...mapActions(['fetchLogout']),

    async logout() {
      await this.fetchLogout()
        .then(response => {
          if (response.status === 200) {
            this.$router.push('/login');
            localStorage.clear();
          }
      })
    }
  },

  computed: mapGetters(['getIsAuth']),
}
</script>

<style scoped>
.navbar {
  width: 100%;
  height: 50px;
  padding: 0 20px;
  background-color: #00c0c0;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.navbar-title {
  font-size: 30px;
  font-weight: bold;
}
.navbar-text {
  text-decoration: none;
  color: white;
}
</style>