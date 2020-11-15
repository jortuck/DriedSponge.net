<template>
  <div class="has-text-centered container">
    <h1 class="title">
      <slot></slot>
      {{ header }}
    </h1>
    <h2 class="subtitle" v-if="sub_header">{{ sub_header }}</h2>
  </div>
</template>

<script>
export default {
  name: "Pagehead",
  props: {
    header: {
      type: String,
      required: false
    },
    sub_header: {
      type: String,
      required: false
    },
    }
}
</script>

<style scoped>

</style>