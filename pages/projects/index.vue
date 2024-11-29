<script lang="ts" setup>
useSeoMeta({
	title: "Jordan Tucker | Projects",
});
</script>
<template>
	<section>
	<h1 class="text-white text-6xl my-10 font-bold">Projects</h1>
	<ContentList path="/projects" v-slot="{list}" >
		<NuxtLink class="text-white" v-for="item in list" :href="item._path">
			{{item.title}}
		</NuxtLink>
	</ContentList>
	</section>
</template>