<template>
  <div class="post-item">
    <div class="post-text">{{post.text}}</div>
    <div class="post-data">
      <span class="post-date">{{post.date}}</span>
      <span class="post-likes">Likes: {{post.likes}}</span>
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
  }
}
</script>

<style scoped>
.post-item {
  margin-bottom: 15px;
  min-height: 50px;
  padding: 10px 15px;
  width: 85%;
  background-color: #f1f1f1;
  border-radius: 20px;
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