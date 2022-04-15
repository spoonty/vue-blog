<template>
  <div class="profile-info">
    <div class="avatar-container">
      <img
          class="avatar"
          src="https://assets.faceit-cdn.net/avatars/ae24192a-0d4c-4e08-9bba-cbfa16c32098_1600452157553.jpg"
      />
    </div>
    <div class="description-container">
      <div class="profile-name profile-text">Sergey Kachalov</div>
      <div class="profile-username profile-text">spoonty</div>
      <div class="profile-status profile-text">TSU student</div>
    </div>
  </div>
</template>

<script>
export default {

}
</script>

<style scoped>
.profile-info {
  margin-top: 20px;
  height: 400px;
  display: grid;
  grid-template-rows: 5fr 7fr;
}
.avatar-container {
  justify-self: flex-start;
  margin-right: 10px;
}
.avatar {
  border-radius: 50%;
}
.description-container {
  margin-left: 10px;
  align-self: flex-start;
}
.profile-name {
  font-weight: bold;
  font-size: 30px;
}
.profile-username {
  font-size: 20px;
  font-weight: lighter;
}
.profile-status {
  margin-top: 10px;
}
.profile-text {
  font-family: Tahoma;
}
@media (max-width: 1200px) {
  .profile-info {
    height: 40%;
    grid-template-columns: 4fr 8fr;
  }
}
</style>