<template>
  <div class="content">
    <div class="users-list followed-list">
      <h1 class="list-text">Following</h1>
      <user-item
          v-for="user in getFollowedUsers"
          :user="user"
          :key = "user.id"
          @follow="followUser"
      ></user-item>
    </div>
    <div class="users-list unfollowed-list">
      <h1 class="list-text">Users</h1>
      <user-item
          v-for="user in getUnfollowedUsers"
          :user="user"
          :key = "user.id"
          @follow="followUser"
      ></user-item>
    </div>
  </div>
</template>

<script>
import UserItem from '@/components/Users/UserItem.vue';
import {mapActions, mapGetters} from "vuex";

export default {
  components: {UserItem},

  async mounted() {
    if (!localStorage.getItem('your_id')) {
      this.$router.push('/login');
      return;
    }

    await this.fetchGetUsers();
  },

  methods: {
    ...mapActions(['fetchGetUsers', 'fetchFollowUser']),

    async followUser(userId) {
      await this.fetchFollowUser(userId);
    }
  },

  computed: mapGetters(['getFollowedUsers', 'getUnfollowedUsers'])
}
</script>

<style scoped>
.content {
  width: 100%;
  display: grid;
  grid-template-columns: 50% 50%;
}
.users-list {
  display: flex;
  flex-direction: column;
  align-items: center;
}
.list-text {
  margin-bottom: 20px;
}
@media (max-width: 1100px) {
  .content {
    display: flex;
    flex-direction: column;
  }
  .unfollowed-list {
    margin-top: 50px;
  }
}
</style>