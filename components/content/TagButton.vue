<script setup lang="ts">
defineProps({
	text: String,
	icon: String,
	url: String,
})
</script>
<template>
	<NuxtLink external target="_blank" :to="url" class="p-3 bg-base-200 hover:bg-base-300 text-white rounded-md font-bold md:text-base text-2xl w-full text-center space-x-1.5">
		<i :class="icon"></i><span class="hidden md:inline">{{text}}</span>
	</NuxtLink>
</template>