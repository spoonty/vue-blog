<template>
  <div class="profile-posts">
    <div v-if="isYourPage" class="input-post-container">
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
      inputText: ''
    }
  },

  props: {
    posts: {
      type: Array,
      required: true
    }
  },

  components: {PostItem},

  methods: {
    addPost() {
      this.$emit('addPost', this.inputText);
      this.inputText='';
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
.profile-posts {
  margin-top: 15px;
  width: 100%;
}
.input-post-container {
  width: 100%;
  margin-bottom: 15px;
  display: grid;
  grid-template-columns: 85% 15%;
}
.input-line {
  width: 100%;
  min-height: 30px;
  resize: none;
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
.posts-container {
  display: flex;
  justify-content: flex-start;
  flex-direction: column;
}
</style>