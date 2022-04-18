<template>
  <div class="content">
    <profile-info
      :key="profile.id"
      :profile="{...profile[0]}"
    />
    <profile-posts
      :posts="newPostsFirst"
      @addPost="addPost"
    />
  </div>
</template>

<script>
import ProfileInfo from '@/components/Profile/ProfileInfo.vue';
import ProfilePosts from '@/components/Profile/ProfilePosts.vue';
import {usersGetUser, postsGetPost, postsAddPost} from '@/API/api';

export default {
  data() {
    return {
      profile: {},
      posts: []
    }
  },

  components: { ProfileInfo, ProfilePosts},

  async mounted() {
    if (!localStorage.getItem('your_id')) {
      this.$router.push('/login');
      return;
    }

    await this.fetchData();
  },

  computed: {
    newPostsFirst() {
      return this.posts.reverse();
    }
  },

  methods: {
    async fetchData() {
      let userId = localStorage.getItem('your_id');
      if (this.$route.path.includes('users')) {
        userId = this.$route.path.substr(7);
      }

      await usersGetUser(userId)
          .then(response => {
            if (response.status === 200) {
              this.profile = response.data;
            }
          })
          .catch(error => {
            console.log(error);
          })

      await postsGetPost(userId)
          .then(response => {
            if (response.status === 200) {
              this.posts = response.data;
            }
          })
          .catch(error => {
            console.log(error);
          })
    },
    async addPost(text) {
      const data = {
        text
      };

      await postsAddPost(data, localStorage.getItem('your_id'))
        .then(async response => {
          if (response.status === 200) {
            await postsGetPost(localStorage.getItem('your_id'))
                .then(response => {
                  if (response.status === 200) {
                    this.posts = response.data;
                  }
                })
                .catch(error => {
                  console.log(error);
                })
          }
        })
        .catch(error => {
          console.log(error);
        })
    }
  }
}
</script>

<style>
.content {
  height: 85%;
  width: 75%;
  display: grid;
  grid-template-columns: 30% 70%;
}
@media (max-width: 1200px) {
  .content {
    display: flex;
    flex-direction: column;
  }
}
</style>