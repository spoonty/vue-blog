<template>
  <form class="register-form" @submit.prevent="confirmForm">
    <h1>Registration</h1>
    <my-input
        class="form-element"
        :incorrectInput="incorrectInput"
        v-model="name" placeholder="Name" type="text"></my-input>
    <my-input
        class="form-element"
        :incorrectInput="incorrectInput || userAlreadyExist"
        v-model="username" placeholder="Username" type="text"></my-input>
    <my-input
        class="form-element"
        :incorrectInput="incorrectInput || incorrectPassword"
        v-model="password" placeholder="Password" type="password"></my-input>
    <my-input
        class="form-element"
        :incorrectInput="incorrectInput || incorrectPassword"
        v-model="passwordR" placeholder="Repeat password" type="password"></my-input>
    <div
        class="incorrect-input-text"
        v-if="incorrectInput || userAlreadyExist || incorrectPassword">{{warningText}}</div>
    <confirm-button class="confirm-btn">Register</confirm-button>
  </form>
</template>

<script>
import MyInput from "@/components/UI/MyInput.vue";
import ConfirmButton from "@/components/UI/ConfirmButton.vue";
import {mapActions} from "vuex";

export default {
  data() {
    return {
      name: '',
      username: '',
      password: '',
      passwordR: '',
      incorrectInput: false,
      userAlreadyExist: false,
      incorrectPassword: false,
      warningText: ''
    }
  },

  components: { MyInput, ConfirmButton },

  methods: {
    ...mapActions(['fetchRegister']),

    async confirmForm() {
      if (this.password === this.passwordR) {
        const data = {
          name: this.name,
          username: this.username,
          password: this.password
        };

        await this.fetchRegister(data)
            .then(response => {
              if (response.status === 200) {
                this.incorrectInput = false;
                this.$router.push('/');
              }
            })
            .catch(error => {
              switch (error.response.status) {
                case 403:
                  this.warningText = 'Data is incorrect';
                  this.incorrectInput = true;
                  this.incorrectPassword = this.userAlreadyExist = false;
                  break;
                case 409:
                  this.warningText = 'User with this nickname already exist';
                  this.userAlreadyExist = true;
                  this.incorrectInput = this.incorrectPassword = false;
                  break;
                default:
                  this.warningText = 'Something went wrong'
              }
            })
      }
      else {
        this.warningText = 'Passwords do not match';
        this.incorrectPassword = true;
        this.incorrectInput = this.userAlreadyExist = false;
      }
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
.incorrect-input-text {
  color: red;
  margin: 0 auto;
}
@media (max-width: 900px) {
  .register-form {
    width: 80%;
  }
}
</style>