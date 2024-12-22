<script lang="ts" setup>
useSeoMeta({
	title: "Projects | Jordan Tucker",
});
</script>
<template>
	<section>
	<h1 class="text-white text-6xl my-10 font-bold">Projects</h1>
	<ContentList path="/projects" v-slot="{list}" >
		<div class="grid md:grid-cols-2 grid-cols-1 gap-3">
			<div v-for="item in list" class="bg-base-200 p-4 rounded-sm">
				<h1 class="text-white text-2xl font-bold">
					{{item.title}}
				</h1>
				<div
					:style="`background-image: url(/thumbnails/${item.thumbnail})`"
					class="h-52 bg-white md:h-80"
				>
					<div class="relative h-full backdrop-blur-2xl">
						<img
							alt={imgAlt}
							class="relative z-40 mx-auto h-full object-contain"
							:src="`/thumbnails/${item.thumbnail}`"
						/>
					</div>
				</div>
			</div>
		</div>
	</ContentList>
	</section>
</template>