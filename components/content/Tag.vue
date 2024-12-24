<script setup lang="ts">
defineProps({
	text: String
})
</script>
<template>
	<span class="space-x-2.5 bg-base-200 py-1 px-2 rounded-md text-sm select-none text-white font-bold">
		{{text}}
	</span>
</template>