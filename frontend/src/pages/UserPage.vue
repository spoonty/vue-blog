<template>
  <div class="content" v-if="getIsAuth">
    <profile-info
        :key=getProfile.id
        :profile=getProfile
    />
    <profile-posts/>
  </div>
</template>

<script>
import ProfileInfo from '@/components/Profile/ProfileInfo.vue';
import ProfilePosts from '@/components/Profile/ProfilePosts.vue';

import {mapGetters, mapActions, mapMutations} from 'vuex';

export default {
  components: { ProfileInfo, ProfilePosts},

  methods: {
    ...mapActions(['fetchGetProfile']),
    ...mapMutations(['resetState', 'setIsAuth'])
  },

  computed: mapGetters(['getProfile', 'getIsAuth']),

  async mounted() {
    if (this.getIsAuth === false) {
      await this.$router.push('/login');
      return;
    }

    let userId = localStorage.getItem('your_id');
    if (this.$route.path.includes('users')) {
      userId = this.$route.path.substr(7);
    }

    await this.fetchGetProfile({userId, returnData: false});
  },

  unmounted() {
    this.resetState();
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