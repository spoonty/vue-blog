<template>
  <div class="users-list followed-list">
    <h1 class="list-text"><slot></slot></h1>
    <user-item
        v-for="user in usersList"
        :user="user"
        :key = "user.id"
        @follow="follow"
    ></user-item>
  </div>
</template>

<script>
import UserItem from '@/components/Users/UserItem.vue';

export default {
  props: {
    usersList: {
      Array,
      required: true
    }
  },

  components: {UserItem},

  methods: {
    follow(id) {
      this.$emit('follow', id);
    }
  }
}
</script>

<style>
.users-list {
  display: flex;
  flex-direction: column;
  align-items: center;
}
.list-text {
  margin-bottom: 20px;
}
</style>