<template>
  <div class="content">
    <profile-info />
    <profile-posts />
  </div>
</template>

<script>
import ProfileInfo from '@/components/Profile/ProfileInfo.vue';
import ProfilePosts from '@/components/Profile/ProfilePosts.vue';

export default {
  components: { ProfileInfo, ProfilePosts}
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