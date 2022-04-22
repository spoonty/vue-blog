<template>
  <div class="content">
    <users-list
      :usersList="getFollowedUsers"
      @follow="followUser"
    >Following</users-list>

    <users-list
      :usersList="getUnfollowedUsers"
      @follow="followUser"
      class="unfollowed-list"
    >Users</users-list>
  </div>
</template>

<script>
import UsersList from '@/components/Users/UsersList.vue';
import {mapActions, mapGetters} from "vuex";

export default {
  components: {UsersList},

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