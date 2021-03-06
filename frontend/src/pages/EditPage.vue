<template>
  <form class="edit-form" @submit.prevent="confirmForm">
    <h1>Edit</h1>
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
        :incorrectInput="incorrectInput"
        v-model="status" placeholder="Status" type="text"></my-input>
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
    <confirm-button class="confirm-btn">Confirm</confirm-button>
    <confirm-button @click.prevent="deleteUser" style="background-color: #ec1515;">Delete profile</confirm-button>
  </form>
</template>

<script>
import MyInput from "@/components/UI/MyInput.vue";
import ConfirmButton from "@/components/UI/ConfirmButton.vue";
import { mapActions } from "vuex";

export default {
  data() {
    return {
      id: 0,
      name: '',
      username: '',
      status: '',
      password: '',
      passwordR: '',
      incorrectInput: false,
      userAlreadyExist: false,
      incorrectPassword: false,
      warningText: ''
    }
  },

  components: { MyInput, ConfirmButton },

  async mounted() {
    await this.fetchGetProfile({userId: localStorage.getItem('your_id'), returnData: true})
        .then(response => {
          if (response.status === 200) {
            const data = response.data[0];

            this.id = data.userId;
            this.name = data.name;
            this.username = data.username;
            this.status = data.status
          }
        })
  },

  methods: {
    ...mapActions(['fetchGetProfile', 'fetchEdit', 'fetchDelete']),

    async deleteUser() {
      this.fetchDelete(this.id)
        .then(response => {
          if (response.status === 200) {
            this.$router.push('/login');
          }
        })
    },

    async confirmForm() {
      if (this.password === this.passwordR || this.password === '' && this.passwordR === '') {
        const data = {
          name: this.name,
          username: this.username,
          status: this.status
        }
        this.password !== '' ? data['password'] = this.password: false;

        await this.fetchEdit({data, userId: localStorage.getItem('your_id')})
          .then(response => {
            if (response.status === 200) {
              this.incorrectInput = this.userAlreadyExist = false;
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
      else if (this.password !== this.passwordR) {
        this.warningText = 'Passwords do not match';
        this.incorrectPassword = true;
        this.incorrectInput = this.userAlreadyExist = false;
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
.incorrect-input-text {
  color: red;
  margin: 0 auto;
}
@media (max-width: 900px) {
  .edit-form {
    width: 80%;
  }
}
</style>