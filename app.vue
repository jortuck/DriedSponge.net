<script lang="ts" setup>
	useSeoMeta({
		ogSiteName:"Jordan Tucker",
		themeColor:"#62a1ec"
	})
</script>
<template>
	<div class="flex h-screen flex-col">
		<Navbar />
		<main class="max-w-7xl container mx-auto flex-1 px-3 xl:px-0  ">
			<NuxtPage/>
		</main>
		<Foot />
	</div>

</template>
<style>
	@import "assets/css/app.css";
</style>