<template>
  <div class="has-text-centered container" data-aos="fade-in">
    <h1 class="title page-title mb-1">
      <slot></slot>
      {{ header }}
    </h1>
    <h2 class="subtitle page-subtitle mt-2" v-if="sub_header">{{ sub_header }}</h2>
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
