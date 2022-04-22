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
          :class="{
              'disabled-btn': !inputText.length
            }"
          :disabled="!inputText.length"
          class="add-post-btn"
      >
        <fa icon="paper-plane" />
      </button>
    </div>
    <div class="posts-container">
      <post-item
          v-for="post in getPosts"
          :post="post"
          :key="post.id"
          @deletePost="deletePost"
          @likePost="likePost"
      />
    </div>
  </div>
</template>

<script>
import PostItem from '@/components/Profile/PostItem.vue';
import {mapActions, mapGetters, mapMutations} from 'vuex';

export default {
  data() {
    return {
      posts: [],
      inputText: ''
    }
  },

  components: {PostItem},

  async mounted() {
    let userId = localStorage.getItem('your_id');
    if (this.$route.path.includes('users')) {
      userId = this.$route.path.substr(7);
    }

    await this.fetchGetPosts(userId);
  },

  unmounted() {
    this.resetState();
  },

  methods: {
    ...mapActions(['fetchGetPosts',
      'fetchAddPost',
      'fetchDeletePost',
      'fetchLikePost']),
    ...mapMutations(['resetState']),

    async addPost() {
      const data = {
        text: this.inputText
      }

      await this.fetchAddPost({
        data,
        userId: localStorage.getItem('your_id')
      });

      this.inputText = '';
    },

    async deletePost(id) {
      await this.fetchDeletePost({
        postId: id,
        userId: localStorage.getItem('your_id')
      });
    },

    async likePost(id) {
      await this.fetchLikePost({
        postId: id,
        userId: this.$route.path.substr(7)
      })
    }
  },

  computed: {
    ...mapGetters(['getPosts']),

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
  padding: 5px;
  resize: none;
  border: 2px solid #009393;
  border-radius: 10px;
}
.input-line:focus {
  border-color: #00c0c0;
  box-shadow: 0 0 8px #007373;
  outline: 0 none;
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
  background-color: #00b6b6;
}
.add-post-btn:active {
  background-color: #00afaf;
}
.disabled-btn,
.disabled-btn:hover,
.disabled-btn:active  {
  background-color: gray;
  opacity: .3;
  cursor: not-allowed;
}
.posts-container {
  display: flex;
  justify-content: flex-start;
  flex-direction: column;
}
</style>