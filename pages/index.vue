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
	<div class="space-y-32">
		<section
			class="mt-20 md:mt-28 lg:mt-40"
		>
			<section class="w-full text-center md:space-y-6 lg:text-left">
				<div
					class="h-full space-y-9 lg:space-y-6 tracking-tighter lg:pr-10 bg-gradient-to-br from-white via-primary to-white to-70%  bg-clip-text text-transparent">
					<h1 class="text-5xl lg:text-7xl font-semibold xl:text-8xl tracking-tighter select-none cooltext">
						Hi, I'm Jordan.
					</h1>
					<h2 class="text-4xl font-semibold sm:h-auto xl:text-6xl tracking-tighter select-none cooltext">I'm a student
						at the University of Washington.</h2>
					<div class="text-5xl space-x-6">
						<a
							target="_blank"
							class="social-link cooltext"
							href="https://github.com/jortuck"
							title="Github"
						>
							<i class="fa-brands fa-github"></i>
						</a>
						<a
							target="_blank"
							class="social-link cooltext"
							href="https://linkedin.com/in/jortuck"
							title="Linked In"
						>
							<i class="fa-brands fa-linkedin"></i>
						</a>
						<a
							class="social-link cooltext"
							href="#contact"
						>
							<i class="fa-solid fa-envelope"></i>
						</a>
					</div>
				</div>
			</section>
		</section>
		<section class="mb-96 space-y-10">
			<div class="space-y-8">
				<h1 class="small-heading">
					About Me
				</h1>
				<p class="section-paragraph">
					Hi my name is Jordan, I'm a student at the <NuxtLink to="https://washington.edu" external target="_blank">University of
					Washington</NuxtLink> in Seattle. I have been teaching myself
					to program since 2019, and have focused my efforts in web development, server-side applications, and data
					science applications. At this point in time, I am currently working at the University of Washington's
					<NuxtLink to="https://ocean.washington.edu" external target="_blank">School
				of Oceanography</NuxtLink> as a research assistant, building an interactive web application for the visualization
					of paleocliamte data reconstructions.
				</p>
				<p class="section-paragraph">
					Nullam id ex quis ligula consequat fringilla. Fusce in viverra enim. Nam pretium metus ac nisi consectetur, ac
					sagittis magna posuere. Duis commodo odio vel molestie iaculis. Suspendisse pellentesque dictum mi, vitae
					pellentesque urna aliquet sit amet. Nullam nec dignissim magna. Curabitur ultricies dignissim lectus, eget
					dictum purus euismod eget.
				</p>
			</div>
			<div class="space-y-8">
				<h1 class="small-heading">
					Technologies I Work With:
				</h1>
				<p class="section-paragraph">
					I have experience with the following technologies:
				</p>
			</div>
			<div>
				<h1 class="small-heading" id="projects">
					Projects
				</h1>
			</div>
			<div>
				<h1 class="small-heading">
					Contact
				</h1>
			</div>
		</section>
	</div>
</template>
<style scoped lang="postcss">
.social-link {
	@apply transition-colors duration-200 ease-in-out hover:text-white ;
}

.cooltext {
	text-shadow: 0 0 90px #555;
}

.small-heading {
	@apply text-2xl md:text-3xl font-bold bg-gradient-to-br from-white via-primary to-white bg-clip-text text-transparent;
}

.section-paragraph {
	@apply text-gray-200;
}

.section-paragraph > a {
	@apply text-primary hover:underline;
}
</style>