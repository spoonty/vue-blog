<template>
  <div class="user-item">
    <img
        class="avatar"
        src="https://assets.faceit-cdn.net/avatars/ae24192a-0d4c-4e08-9bba-cbfa16c32098_1600452157553.jpg"
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
          @click="followAction"
          class="btn follow"
          v-if="user.followed"
      >
        <fa icon="minus" />
      </button>
      <button
          @click="followAction"
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
    followAction() {
      this.$emit('follow', this.user.id);
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
  color: #606060;
}
.username:active {
  color: #b7b7b7;
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