<script setup lang="ts">
import { ref } from "vue";
import { useWindowScroll } from "@vueuse/core";
let scroll = ref(0);
onMounted(()=>{
	let {x, y} = useWindowScroll();
	watch(y, (value) => {
		scroll.value = value;
	});
})
</script>
<template>
	<nav
		class="lg:flex hidden border-b-2 border-b-base-300 bg-base-100 py-4 transition-colors duration-200 ease-in-out lg:border-0"
		:class="{'scrolled':scroll > 0}"
	>
		<div
			class="max-w-6xl container mx-auto hidden items-center justify-between px-2 lg:flex xl:px-0"
		>
			<div>
				<a
					class="text-4xl font-extrabold text-white"
					href="/"><span class="text-primary">J</span>T</a
				>
			</div>
			<div class="links space-x-5">
				<NuxtLink href="/" activeClass="!text-white">
					Home
				</NuxtLink>
				<NuxtLink href="/projects" activeClass="!text-white">
					Projects
				</NuxtLink>
				<NuxtLink
					href="#contact"
				>
					Contact
				</NuxtLink>
			</div>
		</div>
	</nav>
</template>
<style scoped lang="postcss">
.scrolled {
	@apply border-b-2 backdrop-blur-2xl bg-opacity-80;
}
div.links > a {
	@apply text-xl text-gray-400 transition-colors duration-200 ease-in-out hover:text-white font-medium
}
</style>
