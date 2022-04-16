<template>
  <div class="content">
    <user-item
      v-for="user in users"
      :user="user"
      :key = "users.id"
      @follow="followAction"
    ></user-item>
  </div>
</template>

<script>
import UserItem from '@/components/Users/UserItem.vue';

export default {
  data() {
    return {
      users: [
        {id: 1, username: 'spoonty', avatar: 'https://assets.faceit-cdn.net/avatars/ae24192a-0d4c-4e08-9bba-cbfa16c32098_1600452157553.jpg', followed: true},
        {id: 2, username: 'spoonty', avatar: 'https://assets.faceit-cdn.net/avatars/ae24192a-0d4c-4e08-9bba-cbfa16c32098_1600452157553.jpg', followed: false},
        {id: 3, username: 'spoonty', avatar: 'https://assets.faceit-cdn.net/avatars/ae24192a-0d4c-4e08-9bba-cbfa16c32098_1600452157553.jpg', followed: false},
        {id: 4, username: 'spoonty', avatar: 'https://assets.faceit-cdn.net/avatars/ae24192a-0d4c-4e08-9bba-cbfa16c32098_1600452157553.jpg', followed: true},
        {id: 5, username: 'spoonty', avatar: 'https://assets.faceit-cdn.net/avatars/ae24192a-0d4c-4e08-9bba-cbfa16c32098_1600452157553.jpg', followed: true},
        {id: 6, username: 'spoonty', avatar: 'https://assets.faceit-cdn.net/avatars/ae24192a-0d4c-4e08-9bba-cbfa16c32098_1600452157553.jpg', followed: false},
        {id: 7, username: 'spoonty', avatar: 'https://assets.faceit-cdn.net/avatars/ae24192a-0d4c-4e08-9bba-cbfa16c32098_1600452157553.jpg', followed: false},
        {id: 8, username: 'spoonty', avatar: 'https://assets.faceit-cdn.net/avatars/ae24192a-0d4c-4e08-9bba-cbfa16c32098_1600452157553.jpg', followed: false},
        {id: 9, username: 'spoonty', avatar: 'https://assets.faceit-cdn.net/avatars/ae24192a-0d4c-4e08-9bba-cbfa16c32098_1600452157553.jpg', followed: false},
        {id: 10, username: 'spoonty', avatar: 'https://assets.faceit-cdn.net/avatars/ae24192a-0d4c-4e08-9bba-cbfa16c32098_1600452157553.jpg', followed: false},
        {id: 11, username: 'spoonty', avatar: 'https://assets.faceit-cdn.net/avatars/ae24192a-0d4c-4e08-9bba-cbfa16c32098_1600452157553.jpg', followed: false},
        {id: 12, username: 'spoonty', avatar: 'https://assets.faceit-cdn.net/avatars/ae24192a-0d4c-4e08-9bba-cbfa16c32098_1600452157553.jpg', followed: false},
        {id: 13, username: 'spoonty', avatar: 'https://assets.faceit-cdn.net/avatars/ae24192a-0d4c-4e08-9bba-cbfa16c32098_1600452157553.jpg', followed: false},
      ]
    }
  },
  components: {UserItem},
  methods: {
    followAction(id) {
      const userToAction = this.users.filter(u => u.id === id);
      userToAction[0].followed = !userToAction[0].followed;
    }
  }
}
</script>

<style scoped>
.content {
  width: 75%;
  display: flex;
  flex-direction: column;
  align-items: center;
}
</style>