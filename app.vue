<script lang="ts" setup>
	useSeoMeta({
		ogSiteName:"Jordan Tucker",
		themeColor:"#62a1ec"
	})
</script>
<template>
	<div class="flex min-h-screen flex-col">
		<Navbar />
		<main class="max-w-6xl container mx-auto flex-1 px-3 xl:px-0  ">
			<NuxtPage/>
		</main>
		<Foot />
	</div>
</template>
<style>
	@import "assets/css/app.css";
	.page-enter-active,
	.page-leave-active {
		transition: all 0.4s;
	}
	.page-enter-from,
	.page-leave-to {
		opacity: 0;
		filter: blur(1rem);
	}
</style>