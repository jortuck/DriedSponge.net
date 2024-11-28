<script lang="ts" setup>
const { data } = await useAsyncData('home', () => queryContent('projects').find())
console.log("Query")
</script>
<template>
	{{ data[0].title }}
</template>