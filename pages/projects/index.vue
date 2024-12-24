<script lang="ts" setup>
useSeoMeta({
	title: "Projects | Jordan Tucker",
	ogTitle: "Projects | Jordan Tucker"
});
</script>
<template>
	<section class="mb-10">
		<h1 class="text-white md:text-6xl text-5xl my-10 font-bold">Projects</h1>
		<ContentList path="/projects" v-slot="{list}">
			<div class="grid md:grid-cols-2 grid-cols-1 gap-3 my-3">
				<div v-for="item in list" class="rounded-md flex flex-col border-base-200 border-2 hover:border-base-300 transition-colors duration-400 ease-in-out">
					<div class="m-2 space-y-2 flex-1">
						<div class="space-x-2">
							<NuxtLink :to="item._path" class="md:text-2xl text-xl font-bold text-primary hover:underline">
								{{ item.title }}
							</NuxtLink>
						</div>
						<p class="text-white">
							{{ item.description }}
						</p>
					</div>
					<div class="text-white m-2 space-x-2.5">
						<NuxtLink :to="`${item._path}`" class="space-x-2.5 bg-base-200 hover:bg-base-300 py-1 px-2 rounded-md text-sm select-none">
							View Project <i class="fa-solid fa-arrow-right"></i>
						</NuxtLink>
						<NuxtLink v-if="item.github" target="_blank" external :to="`https://github.com/jortuck/${item.github}`" class="space-x-2.5 bg-base-200 hover:bg-base-300 py-1 px-2 rounded-md  text-sm select-none">
						Source Code <i class="fa-regular fa-arrow-up-right-from-square ml-1 fa-sm"></i>
						</NuxtLink>
					</div>
				</div>
			</div>
		</ContentList>
	</section>
</template>