<script lang="ts" setup>
useSeoMeta({
	title: "Projects | Jordan Tucker",
	ogTitle: "Projects | Jordan Tucker"
});
</script>
<template>
	<section class="mb-10">
		<h1 class="my-10 text-5xl font-bold text-white md:text-6xl">Projects</h1>
		<ContentList
			path="/projects"
			v-slot="{ list }"
		>
			<div class="my-3 grid grid-cols-1 gap-3 md:grid-cols-2">
				<ProjectCard
					v-for="item in list"
					:title="item.title"
					:link="item._path"
					:github="item.github"
					:description="item.description"
				/>
			</div>
		</ContentList>
	</section>
</template>
