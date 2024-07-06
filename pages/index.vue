<script setup lang="ts">
useSeoMeta({
	title: "Jordan Tucker | Home",
	ogTitle: "Jordan Tucker | Home",
	description: "Hello, my name is Jordan. I'm a student studying at the University of Washington. I enjoy creating websites, Discord bots, & more!",
	ogDescription: "Hello , my name is Jordan. I'm a student studying at the University of Washington. I enjoy creating websites, Discord bots, & more!",
	ogUrl: "https://jortuck.com"
});
</script>
<template>
	<div class="space-y-80">
		<section
			class="mt-20 flex flex-col items-center justify-between space-y-10 align-middle md:mt-28 lg:mt-40 lg:flex-row lg:space-y-0"
		>
			<section class="w-full text-center md:space-y-6 lg:text-left">
				<div class="h-full space-y-4 tracking-tighter lg:pr-10 bg-gradient-to-br from-white via-primary to-white to-70%  bg-clip-text text-transparent">
					<h1 class="text-5xl font-semibold sm:h-auto xl:text-8xl tracking-tighter select-none">
						Hi, I'm Jordan.
					</h1>
					<h2 class="text-4xl font-semibold sm:h-auto xl:text-6xl tracking-tighter select-none">I'm a student at the University of Washington.</h2>
					<div class="text-5xl space-x-6 text-gray-200">
						<a
							target="_blank"
							class="social-link"
							href="https://github.com/jortuck"
							title="Github"
						>
							<i class="fa-brands fa-github"></i>
						</a>
						<a
							target="_blank"
							class="social-link"
							href="https://linkedin.com/in/jortuck"
							title="Linked In"
						>
							<i class="fa-brands fa-linkedin"></i>
						</a>
						<a
							class="social-link"
							href="#contact"
						>
							<i class="fa-solid fa-envelope"></i>
						</a>
					</div>
				</div>
			</section>
		</section>
		<section class="">
			<div class="bg-base-200 space-y-8 p-8 mb-96 rounded-lg">
				<h1 class="text-white text-2xl font-bold">
					About Me
				</h1>
				<p class="text-gray-100">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eu ullamcorper felis, ut tincidunt mauris.
					Phasellus pulvinar dui sit amet leo volutpat gravida. Class aptent taciti sociosqu ad litora torquent per
					conubia nostra, per inceptos himenaeos. Ut eu eleifend erat, ut lobortis libero. Ut finibus ex in justo congue
					ullamcorper. Phasellus at volutpat justo. Maecenas eu fermentum odio. Nullam bibendum nulla eu lectus interdum
					cursus. Praesent commodo magna vel mi tempus finibus. In ullamcorper, erat vitae placerat pellentesque, erat
					metus viverra felis, quis tristique velit diam eu purus.
				</p>
				<p class="text-gray-100">
					Nullam id ex quis ligula consequat fringilla. Fusce in viverra enim. Nam pretium metus ac nisi consectetur, ac
					sagittis magna posuere. Duis commodo odio vel molestie iaculis. Suspendisse pellentesque dictum mi, vitae
					pellentesque urna aliquet sit amet. Nullam nec dignissim magna. Curabitur ultricies dignissim lectus, eget
					dictum purus euismod eget.
				</p>
			</div>
		</section>
	</div>
</template>
<style scoped lang="postcss">
.social-link{
	@apply transition-colors duration-200 ease-in-out hover:text-white;
}
</style>