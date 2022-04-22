<template>
  <div class="user-item">
    <img
        class="avatar"
        src="https://cdn.onlinewebfonts.com/svg/download_568656.png"
    />
    <a
        @click="$router.push(`/users/${user.userId}`)"
        class="username"
        href="#"
    >
      {{user.username}}
    </a>
    <div class="followed">
      <button
          @click="followUser"
          class="btn follow"
          v-if="user.followed"
      >
        <fa icon="minus" />
      </button>
      <button
          @click="followUser"
          class="btn unfollow"
          v-else
      >
        <fa icon="plus" />
      </button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    user: {
      type: Object,
      required: true
    }
  },

  methods: {
    followUser() {
      this.$emit('follow', this.user.userId);
    }
  }
}
</script>

<style scoped>
.user-item {
  margin-bottom: 15px;
  min-height: 100px;
  padding: 10px 15px;
  width: 500px;
  background-color: #f1f1f1;
  border-radius: 20px;
  display: grid;
  grid-template-columns: 20% 60% 20%;
}
.avatar {
  width: 80px;
  border-radius: 50%;
}
.username {
  color: black;
  text-decoration: none;
  margin-left: 10px;
  font-size: 22px;
  font-weight: bold;
  align-self: center;
  justify-self: flex-start;
}
.username:hover {
  color: #363636;
}
.username:active {
  color: #505050;
}
.followed {
  align-self: center;
  justify-self: center;
}
.btn {
  border: none;
  font-size: 20px;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  cursor: pointer;
}
.follow {
  background-color: #53ee53;
}
.unfollow {
  background-color: #ee5353;
}
</style>