<template>
  <form class="register-form" @submit.prevent="confirmForm">
    <h1>Registration</h1>
    <my-input class="form-element" v-model="name" placeholder="Name" type="text"></my-input>
    <my-input class="form-element" v-model="username" placeholder="Username" type="text"></my-input>
    <my-input class="form-element" v-model="password" placeholder="Password" type="password"></my-input>
    <my-input class="form-element" v-model="passwordR" placeholder="Repeat password" type="password"></my-input>
    <confirm-button class="confirm-btn"></confirm-button>
  </form>
</template>

<script>
import MyInput from "@/components/UI/MyInput.vue";
import ConfirmButton from "@/components/UI/ConfirmButton.vue";
import {authRegister} from "@/API/api";

export default {
  data() {
    return {
      name: '',
      username: '',
      password: '',
      passwordR: ''
    }
  },
  components: { MyInput, ConfirmButton },
  methods: {
    confirmForm() {
      
    }
  }
}
</script>

<style scoped>
.register-form {
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