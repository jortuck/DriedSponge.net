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
				<div
					v-for="item in list"
					class="duration-400 from-base-150 flex flex-col rounded-md border-2 border-base-200 bg-gradient-to-br to-base-100 transition-colors ease-in-out hover:border-base-300"
				>
					<div class="m-2 flex-1 space-y-2">
						<div class="space-x-2">
							<NuxtLink
								:to="item._path"
								class="text-xl font-bold text-primary hover:underline md:text-2xl"
							>
								{{ item.title }}
							</NuxtLink>
						</div>
						<p class="text-white">
							{{ item.description }}
						</p>
					</div>
					<div class="m-2 space-x-2.5 text-white">
						<NuxtLink
							:to="`${item._path}`"
							class="select-none space-x-2.5 rounded-md bg-base-200 px-2 py-1 text-sm hover:bg-base-300"
						>
							View Project <i class="fa-solid fa-arrow-right"></i>
						</NuxtLink>
						<NuxtLink
							v-if="item.github"
							target="_blank"
							external
							:to="`https://github.com/jortuck/${item.github}`"
							class="select-none space-x-2.5 rounded-md bg-base-200 px-2 py-1 text-sm hover:bg-base-300"
						>
							Source Code <i class="fa-regular fa-arrow-up-right-from-square fa-sm ml-1"></i>
						</NuxtLink>
					</div>
				</div>
			</div>
		</ContentList>
	</section>
</template>
