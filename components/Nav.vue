<script setup lang="ts">
import { ref } from "vue";

let menuBarOpen = ref(false)

</script>
<template>
	<div class="sticky top-0 z-50 will-change-transform">
		<nav
			class="flex border-b-2 border-b-bgborder bg-bgsecondary py-4 transition-colors duration-200 ease-in-out lg:border-0 lg:bg-transparent"
		>
			<div
				class="max-w-8xl container mx-auto flex hidden items-center justify-between px-2 lg:flex xl:px-0"
			>
				<div>
					<a
						class="text-3xl font-extrabold text-white"
						href="/"><span class="text-primary">Jordan</span> Tucker</a
					>
				</div>
				<div class="links space-x-10">
					<a
						href="/"
					>
						Home
					</a>
					<a
						href="#projects"
					>
						Projects
					</a>
					<a
						href="#contact"
					>
						Contact
					</a>
					<a
						href="/blog"
					>
						Blog
					</a>
				</div>
			</div>
			<div class="container mx-3 max-w-full transition-all duration-200 ease-in-out lg:hidden">
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
			class="absolute z-10 w-full origin-top bg-bgsecondary transition-all duration-200 ease-in-out lg:hidden"
		>
			<ul class="space-y-4 py-4 text-center">
				<li>
					<a
						href="/"
					>
						Home
					</a>
				</li>
				<li>
					<a
						href="#projects"
					>
						Projects
					</a>
				</li>
				<li>
					<a
						href="#contact"
					>
						Contact
					</a>
				</li>
				<li>
					<a
						href="/blog"
					>
						Blog
					</a>
				</li>
			</ul>
		</div>
	</div>
</template>
<style lang="postcss" scoped>
.scrolled {
	@apply border-b-2 bg-bgsecondary;
}
li > a, div.links > a {
	@apply text-xl text-gray-400 transition-colors duration-200 ease-in-out hover:text-white
}
</style>
