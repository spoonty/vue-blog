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
import {postsGetPost, postsLikePost, postsAddPost, postsDeletePost} from '@/API/api';
import {mapActions, mapGetters, mapMutations} from 'vuex';

export default {
  data() {
    return {
      posts: [],
      inputText: ''
    }
  },


  components: {PostItem},

  computed: {
    ...mapGetters(['getPosts']),

    isYourPage() {
      return !this.$route.path.includes('/users/');
    }
  },

  async mounted() {
    let userId = localStorage.getItem('your_id');
    if (this.$route.path.includes('users')) {
      userId = this.$route.path.substr(7);
    }

    await this.fetchPosts(userId);
    // await postsGetPost(userId)
    //     .then(response => {
    //       if (response.status === 200) {
    //         this.posts = response.data;
    //       }
    //     })
    //     .catch(error => {
    //       console.log(error);
    //     })
  },

  unmounted() {
    this.resetState();
  },

  methods: {
    ...mapActions(['fetchPosts']),
    ...mapMutations(['resetState'])
    // async addPost() {
    //   const data = {
    //     text: this.inputText
    //   };
    //
    //   await postsAddPost(data, localStorage.getItem('your_id'))
    //       .then(async response => {
    //         if (response.status === 200) {
    //           await postsGetPost(localStorage.getItem('your_id'))
    //               .then(response => {
    //                 if (response.status === 200) {
    //                   this.posts = response.data;
    //                 }
    //               })
    //               .catch(error => {
    //                 console.log(error);
    //               })
    //         }
    //       })
    //       .catch(error => {
    //         console.log(error);
    //       })
    //
    //   this.inputText = '';
    // },
    //
    // async deletePost(id) {
    //   await postsDeletePost(id)
    //       .then(async response => {
    //         if (response.status === 200) {
    //           await postsGetPost(localStorage.getItem('your_id'))
    //               .then(response => {
    //                 if (response.status === 200) {
    //                   this.posts = response.data;
    //                 }
    //               })
    //               .catch(error => {
    //                 console.log(error);
    //               })
    //         }
    //       })
    //       .catch(error => {
    //         console.log(error);
    //       })
    // },
    //
    // async likePost(id) {
    //   await postsLikePost(id)
    //       .then(async response => {
    //         if (response.status === 200) {
    //           await postsGetPost(this.$route.path.substr(7))
    //               .then(response => {
    //                 if (response.status === 200) {
    //                   this.posts = response.data;
    //                 }
    //               })
    //               .catch(error => {
    //                 console.log(error);
    //               })
    //         }
    //       })
    //       .catch(error => {
    //         console.log(error);
    //       })
    // }
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