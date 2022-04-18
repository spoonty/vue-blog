<template>
  <form class="login-form" @submit.prevent="confirmForm">
    <h1>Login</h1>
    <my-input class="form-element" v-model="username" placeholder="Username" type="text"></my-input>
    <my-input class="form-element" v-model="password" placeholder="Password" type="password"></my-input>
    <confirm-button class="confirm-btn"></confirm-button>
  </form>
</template>

<script>
import MyInput from "@/components/UI/MyInput.vue";
import ConfirmButton from "@/components/UI/ConfirmButton.vue";
import {authLogin} from "@/API/api";

export default {
  data() {
    return {
      username: '',
      password: ''
    }
  },
  components: { MyInput, ConfirmButton },
  methods: {
    confirmForm() {
      const data = {
        username: this.username,
        password: this.password
      }

      authLogin(data)
      .then(response => {
        if (response.status === 200) {
          localStorage.setItem('my_token', response.data.token);
          localStorage.setItem('your_id', response.data.id);
          this.$router.push('/');
        }
      })
      .catch(error => {
        console.log(error);
      })
    }
  }
}
</script>

<style scoped>
.login-form {
  height: 85%;
  width: 50%;
  display: flex;
  flex-direction: column;
}
h1 {
  align-self: center;
  margin-bottom: 30px;
}
.form-element {
  height: 40px;
  padding: 0 15px;
  margin: 15px 0;
}
</style>