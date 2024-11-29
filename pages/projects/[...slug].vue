<template>
	<section class="my-10 space-y-4">
		<NuxtLink href="/projects" class="text-white rounded-md un"><i class="fa-solid fa-arrow-left"></i> Back To Projects</NuxtLink>
		<div class="project-content">
			<ContentDoc />
		</div>
	</section>
</template>/
<style lang="postcss">
.project-content h1 {
	@apply text-white text-6xl font-bold;
}
</style>/
<script setup lang="ts">
</script>