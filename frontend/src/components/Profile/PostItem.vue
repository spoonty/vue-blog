<template>
  <div class="item-container">
    <div v-if="isYourPage" class="delete-btn-container">
      <button @click="deletePost" class="deletePost-btn">
        <fa icon="xmark" />
      </button>
    </div>
    <div class="post-item">
      <div class="post-text">{{post.text}}</div>
      <div class="post-data">
        <span class="post-date">{{post.date}}</span>
        <span class="post-likes">Likes: {{post.likes}}</span>
      </div>
    </div>
    <div v-if="!isYourPage" class="like-btn-container">
      <button @click="likePost" class="likePost-btn">
        <fa icon="heart" />
      </button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    post: {
      type: Object,
      required: true
    }
  },
  computed: {
    isYourPage() {
      return !this.$route.path.includes('/users/');
    }
  },
  methods: {
    deletePost() {
      this.$emit('deletePost', this.post.postId);
    },
    likePost() {
      this.$emit('likePost', this.post.postId);
    }
  }
}
</script>

<style scoped>
.item-container {
  width: 100%;
}
.post-item {
  margin-bottom: 15px;
  min-height: 50px;
  padding: 10px 20px;
  width: 85%;
  background-color: #f1f1f1;
  border-radius: 20px;
  margin-top: 10px;
}
.delete-btn-container,
.like-btn-container {
  width: 85%;
  margin-left: 10px;
  display: flex;
  justify-content: flex-end;
}
.like-btn-container {
  align-items: flex-end;
}
.deletePost-btn,
.likePost-btn {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  position: absolute;
  border: none;
  cursor: pointer;
  font-size: 17px;
}
.deletePost-btn {
  background-color: #c0c0c0;
}
.likePost-btn {
  background-color: #ee5353;
  color: white;
}
.post-data {
  margin-top: 7px;
  display: grid;
  grid-template-columns: 50% 50%;
}
.post-likes {
  justify-self: end;
  color: #737373;
}
.post-date {
  color: #737373;
}
</style>