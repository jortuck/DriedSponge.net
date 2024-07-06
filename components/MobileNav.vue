<script setup lang="ts">
import { ref } from "vue";

let menuBarOpen = ref(false)

</script>

<template>
	<nav
		class="flex  py-4 lg:hidden nav-bg"
	>
	<div class="container mx-3 max-w-full transition-all duration-200 ease-in-out lg:hidden ">
		<div class="flex items-center justify-between">
			<div>
				<a
					class="text-3xl font-extrabold text-white"
					href="/"><span class="text-primary">J</span>T</a
				>
			</div>
			<div>
				<button
					v-on:click="menuBarOpen = !menuBarOpen"
				>
					<img
						v-show="menuBarOpen"
						class="w-6"
						src="/assets/icons/cross.svg"
						alt="Menu Button"
					/>
					<img
						v-show="!menuBarOpen"
						class="w-6"
						src="/assets/icons/menu-burger.svg"
						alt="Menu Button"
					/>
				</button>
			</div>
		</div>
		<div />
	</div>
	</nav>
	<div
		:class="{'scale-y-0':!menuBarOpen}"
		class="absolute z-10 w-full origin-top nav-bg transition-all duration-200 ease-in-out lg:hidden"
	>
		<ul class="space-y-4 py-4 text-center">
			<li>
				<NuxtLink
					href="/"
					activeClass="!text-white"
				>
					Home
				</NuxtLink>
			</li>
			<li>
				<NuxtLink
					href="#projects"
				>
					Projects
				</NuxtLink>
			</li>
			<li>
				<NuxtLink
					href="#contact"
				>
					Contact
				</NuxtLink>
			</li>
			<li>
				<NuxtLink
					href="/blog"
					activeClass="!text-white"
				>
					Blog
				</NuxtLink>
			</li>
		</ul>
	</div>
</template>
<style scoped lang="postcss">
li > a {
	@apply text-xl text-gray-400 transition-colors duration-200 ease-in-out hover:text-white
}
.nav-bg{
	@apply bg-base-100 bg-opacity-80 backdrop-blur-2xl border-b-2 border-b-base-300;
}
</style>