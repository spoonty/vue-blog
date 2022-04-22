<template>
  <div style="height: 100%">
    <navbar-panel />
    <div class="content-wrapper">
      <router-view :key="$route.fullPath"></router-view>
    </div>
  </div>
</template>

<script>
import NavbarPanel from '@/components/UI/NavbarPanel.vue';

export default {
  components: { NavbarPanel}
}
</script>

<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Tahoma;
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
</style>