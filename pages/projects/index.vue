<script lang="ts" setup>
useSeoMeta({
	title: "Projects | Jordan Tucker"
});
</script>
<template>
	<section>
		<h1 class="text-white md:text-6xl text-5xl my-10 font-bold">Projects</h1>
		<ContentList path="/projects" v-slot="{list}">
			<div class="grid md:grid-cols-2 grid-cols-1 gap-3 my-3">
				<NuxtLink :to="item._path" v-for="item in list" class="block bg-base-100 rounded-md flex flex-col border-base-200 hover:border-base-300 border-2">
					<div class="m-2 space-y-1 flex-1">
						<a class="text-2xl font-bold text-primary">
							{{ item.title }}
						</a>
						<p class="text-white">
							{{ item.description }}
						</p>
					</div>
					<div class="text-white text-2xl m-2 space-x-2.5">
						<i class="fa-brands fa-github"></i><i class="fa-solid fa-globe"></i>
					</div>
				</NuxtLink>
			</div>
		</ContentList>
	</section>
</template>