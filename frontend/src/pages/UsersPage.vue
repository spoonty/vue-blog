<template>
  <div class="content">
    <div class="users-list followed-list">
      <h1 class="list-text">Following</h1>
      <user-item
          v-for="user in followedOnly"
          :user="user"
          :key = "users.id"
          @follow="followAction"
      ></user-item>
    </div>
    <div class="users-list unfollowed-list">
      <h1 class="list-text">Users</h1>
      <user-item
          v-for="user in unfollowedOnly"
          :user="user"
          :key = "users.id"
          @follow="followAction"
      ></user-item>
    </div>
  </div>
</template>

<script>
import UserItem from '@/components/Users/UserItem.vue';
import {usersGetUsers} from '@/API/api';

export default {
  data() {
    return {
      users: []
    }
  },
  components: {UserItem},

  async mounted() {
    if (!localStorage.getItem('your_id')) {
      this.$router.push('/login');
      return;
    }

    await usersGetUsers()
      .then(response => {
        if (response.status === 200) {
          this.users = response.data;
        }
      })
      .catch(error => {
        console.log(error);
      })
  },

  methods: {
    followAction(id) {
      const userToAction = this.users.filter(u => u.id === id);
      userToAction[0].followed = !userToAction[0].followed;
    }
  },
  computed: {
    followedOnly() {
      const yourId = localStorage.getItem('your_id');
      return this.users.filter(u => u.followed === true && u.userId != yourId);
    },
    unfollowedOnly() {
      const yourId = localStorage.getItem('your_id');
      return this.users.filter(u => u.followed === false && u.userId != yourId);
    }
  }
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