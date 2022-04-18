<template>
  <form class="edit-form" @submit.prevent="confirmForm">
    <h1>Edit</h1>
    <my-input class="form-element" v-model="name" placeholder="Name" type="text"></my-input>
    <my-input class="form-element" v-model="username" placeholder="Username" type="text"></my-input>
    <my-input class="form-element" v-model="status" placeholder="Status" type="text"></my-input>
    <my-input class="form-element" v-model="password" placeholder="Password" type="password"></my-input>
    <my-input class="form-element" v-model="passwordR" placeholder="Repeat password" type="password"></my-input>
    <confirm-button class="confirm-btn"></confirm-button>
  </form>
</template>

<script>
import MyInput from "@/components/UI/MyInput.vue";
import ConfirmButton from "@/components/UI/ConfirmButton.vue";
import { usersGetUser, usersEditUser } from '@/API/api';

export default {
  data() {
    return {
      name: '',
      username: '',
      status: '',
      password: '',
      passwordR: ''
    }
  },

  components: { MyInput, ConfirmButton },

  mounted() {
    usersGetUser(localStorage.getItem('your_id'))
        .then(response => {
          if (response.status === 200) {
            const data = response.data[0];

            this.name = data.name;
            this.username = data.username;
            this.status = data.status
          }
        })
        .catch(error => {
          console.log(error);
        })
  },

  methods: {
    async confirmForm() {
      if (this.password === this.passwordR || this.password === '' && this.passwordR === '') {
        const data = {
          name: this.name,
          username: this.username,
          status: this.status
        }
        this.password !== '' ? data['password'] = this.password: false;

        await usersEditUser(data, localStorage.getItem('your_id'))
          .then(response => {
            if (response.status === 200) {
              this.$router.push('/');
            }
          })
          .catch(error => {
            console.log(error);
          })
      }
    }
  }
}
</script>

<style scoped>
.edit-form {
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