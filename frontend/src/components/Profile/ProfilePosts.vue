<template>
  <div class="profile-posts">
    <div class="input-post-container">
      <div>
        <textarea class="input-line" />
      </div>
      <button class="add-post-btn">
        <fa icon="paper-plane" />
      </button>
    </div>
  </div>
</template>

<script>
export default {

}
</script>

<style scoped>
.profile-posts {
  margin-top: 15px;
  width: 100%;
}
.input-post-container {
  width: 100%;
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