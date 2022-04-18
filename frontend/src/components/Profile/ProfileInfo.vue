<template>
  <div class="profile-info">
    <div class="avatar-container">
      <img
          class="avatar"
          src="https://assets.faceit-cdn.net/avatars/ae24192a-0d4c-4e08-9bba-cbfa16c32098_1600452157553.jpg"
      />
    </div>
    <div class="description-container">
      <div class="profile-name">{{ profile.name }}</div>
      <div class="profile-username">{{ profile.username }}</div>
      <div v-if="profile.status" class="profile-status">{{ profile.status }}</div>
      <div v-else-if="profile.status === null || !profile.status?.length" class="profile-status"><i>Empty status</i></div>
      <button @click="$router.push('/edit')" v-if="isYourPage" class="profile-edit">
        Edit profile
      </button>
      <div class="profile-followers">
        <fa icon="user" /> <b>{{ profile.followers }}</b> follower
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    profile: {
      type: Object,
      required: true
    }
  },
  computed: {
    isYourPage() {
      return !this.$route.path.includes('/users/');
    }
  }
}
</script>

<style scoped>
.profile-info {
  margin-top: 20px;
  height: 400px;
  display: grid;
  grid-template-rows: 5fr 7fr;
}
.avatar-container {
  justify-self: flex-start;
  margin-right: 10px;
}
.avatar {
  border-radius: 50%;
}
.description-container {
  margin-left: 10px;
  align-self: flex-start;
}
.profile-name {
  font-weight: bold;
  font-size: 30px;
}
.profile-username {
  font-size: 20px;
  font-weight: lighter;
}
.profile-status {
  margin-top: 10px;
  cursor: pointer;
}
.profile-edit {
  width: 65%;
  height: 30px;
  margin-top: 15px;
  background-color: #f1f1f1;
  border-radius: 10px;
  border: 1px solid #adadad;
  cursor: pointer;
}
.profile-edit:hover {
  background-color: #ececec;
}
.profile-edit:active {
  background-color: #e3e3e3;
}
.profile-followers {
  margin-top: 15px;
}
@media (max-width: 1200px) {
  .profile-info {
    height: 40%;
    grid-template-columns: 4fr 8fr;
  }
}
</style>