<template>
  <button class="confirm-btn" ><slot></slot></button>
</template>

<style scoped>
.confirm-btn {
  width: 40%;
  height: 45px;
  color: white;
  font-size: 20px;
  font-weight: bold;
  background-color: #00c0c0;
  margin-top: 30px;
  border: none;
  border-radius: 20px;
  align-self: center;
  cursor: pointer;
}
.confirm-btn:hover {
  background-color: #00b6b6;
}
.confirm-btn:active {
  background-color: #00afaf;
}
</style>