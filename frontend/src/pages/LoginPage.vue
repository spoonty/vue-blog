<template>
  <form class="login-form" @submit.prevent="confirmForm">
    <h1>Login</h1>
    <my-input class="form-element" :incorrectInput="incorrectData" v-model="username" placeholder="Username" type="text"></my-input>
    <my-input class="form-element" :incorrectInput="incorrectData" v-model="password" placeholder="Password" type="password"></my-input>
    <div class="incorrect-data-text" v-if="incorrectData">{{warningText}}</div>
    <confirm-button class="confirm-btn"></confirm-button>
  </form>
</template>

<script>
import MyInput from "@/components/UI/MyInput.vue";
import ConfirmButton from "@/components/UI/ConfirmButton.vue";
import {authLogin} from "@/API/api";
import {mapMutations, mapActions} from "vuex";

export default {
  data() {
    return {
      username: '',
      password: '',
      incorrectData: false,
      warningText: ''
    }
  },
  components: { MyInput, ConfirmButton },
  methods: {
    ...mapMutations(['setIsAuth']),
    ...mapActions(['fetchLogin']),

    async confirmForm() {
      const data = {
        username: this.username,
        password: this.password
      }

      await this.fetchLogin(data)
        .then((response) => {
          if (response.status === 200) {
            this.$router.push('/');
          }
        })
        .catch(error => {
            this.incorrectData = true;
            if (error.response.status === 403) {
              this.warningText = 'Incorrect login or password';
            }
            else {
              this.warningText = 'Something went wrong';
            }
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
.incorrect-data-text {
  color: red;
  margin: 0 auto;
}
@media (max-width: 900px) {
  .login-form {
    width: 80%;
  }
}
</style>