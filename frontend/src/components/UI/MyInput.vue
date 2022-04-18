<template>
  <input
      :value="modelValue"
      @input="updateInput"
      class="input-line"
  />
</template>

<script>
export default {
  props: {
    modelValue: String
  },
  methods: {
    updateInput(event) {
      this.$emit('update:modelValue', event.target.value);
    }
  }
}
</script>

<style scoped>
.input-line {
  font-size: 17px;
  border: 2px solid #009393;
  border-radius: 10px;
}
.input-line:focus {
  border-color: #00c0c0;
  box-shadow: 0 0 8px #007373;
  outline: 0 none;
}
</style>