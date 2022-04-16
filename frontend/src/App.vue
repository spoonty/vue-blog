<template>
  <div style="height: 100%">
    <navbar-panel />
    <router-view></router-view>
  </div>
</template>

<script>
import NavbarPanel from '@/components/NavbarPanel.vue';

export default {
  components: { NavbarPanel}
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
</style>