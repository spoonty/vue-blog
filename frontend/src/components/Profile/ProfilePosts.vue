<template>
  <div class="profile-posts">
    <div class="input-post-container">
      <div>
        <textarea
            v-model="inputText"
            class="input-line"
        />
      </div>
      <button
          @click="addPost"
          class="add-post-btn"
      >
        <fa icon="paper-plane" />
      </button>
    </div>
    <div class="posts-container">
      <post-item
          v-for="post in this.posts"
          :post="post"
          :key="post.id"
      />
    </div>
  </div>
</template>

<script>
import PostItem from '@/components/Profile/PostItem.vue';

export default {
  data() {
    return {
      posts: [
        {id: 3, text: "Hello there. Again...", date: "12-04-2022", likes: 11},
        {id: 2, text: "The day is ending", date: "11-04-2022", likes: 3},
        {id: 1, text: "Hello there. Whats up?", date: "11-04-2022", likes: 1},
    ],
      inputText: ''
    }
  },

  components: {PostItem},

  methods: {
    addPost() {
      const date = new Date();

      const post = {
        id: this.posts[0].id + 1,
        text: this.inputText,
        date: `${
          date.getDate() >= 10
              ? date.getDate()
              : `0${date.getDate()}`
        }-${
          date.getMonth() + 1 >= 10
              ? date.getMonth() + 1
              : `0${date.getMonth() + 1}`
        }-${date.getFullYear()}`,
        likes: 0
      }

      this.posts.unshift(post);
      this.inputText='';
    }
  }
}
</script>

<style scoped>
.profile-posts {
  margin-top: 15px;
  width: 100%;
}
.input-post-container {
  width: 100%;
  margin-bottom: 15px;
  display: grid;
  grid-template-columns: 11fr 1fr;
  align-items: center;
}
.input-line {
  width: 100%;
  min-height: 30px;
}
.add-post-btn {
  height: 50px;
  width: 50px;
  background-color: #00c0c0;
  border-radius: 50%;
  justify-self: center;
  border: none;
  cursor: pointer;
}
.add-post-btn svg {
  font-size: 20px;
  color: white;
}
.add-post-btn:hover {
  background-color: #009a9a;
}
.add-post-btn:active {
  background-color: #007070;
}
</style>