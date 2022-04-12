<template>
  <div style="height: 100%">
    <navbar-panel />
    <div class="content-wrapper">
      <div class="content">
        <profile-info />
        <profile-posts />
      </div>
    </div>
  </div>
</template>

<script>
import NavbarPanel from '@/components/NavbarPanel.vue';
import ProfileInfo from '@/components/Profile/ProfileInfo.vue';
import ProfilePosts from '@/components/Profile/ProfilePosts.vue';

export default {
  components: {NavbarPanel, ProfileInfo, ProfilePosts}
}
</script>

<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
body, html, body #app {
  width: 100%;
  height: 100%;
}
.content-wrapper {
  height: calc(100% - 50px);
  display: flex;
  align-items: center;
  justify-content: center;
}
.content {
  height: 85%;
  width: 75%;
}
</style>