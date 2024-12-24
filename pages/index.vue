<script setup lang="ts">
import Shield from "~/components/Shield.vue";

useSeoMeta({
	title: "Home | Jordan Tucker",
	ogTitle: "Home | Jordan Tucker",
	description: "Hello, my name is Jordan. I'm a student studying Informatics at the University of Washington. I enjoy creating websites, Discord bots, & more!",
	ogDescription: "Hello , my name is Jordan. I'm a student studying Informatics at the University of Washington. I enjoy creating websites, Discord bots, & more!",
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
					<h2 class="text-4xl font-semibold sm:h-auto xl:text-6xl tracking-tighter select-none cooltext">I'm an Informatics student
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
					Hi my name is Jordan, I'm a student studying <NuxtLink external target="_blank" to="https://ischool.uw.edu/programs/informatics">Informatics</NuxtLink> at the <NuxtLink to="https://washington.edu" external target="_blank">University of
					Washington</NuxtLink>. I have been teaching myself
					to program since 2019, and have focused my efforts in web development, server-side applications, and data
					science applications. My most recent project involved working at the University of Washington's
					<NuxtLink to="https://ocean.washington.edu" external target="_blank">School
				of Oceanography</NuxtLink> as a research assistant, building an interactive web application for the visualization
					of paleocliamte data reconstructions. You can check it out <NuxtLink to="https://pv.jortuck.com" external target="_blank">here</NuxtLink>.
				</p>
			</div>
			<div>
				<h1 class="small-heading" id="projects">
					Featured Projects
				</h1>
				<a>View All Projects</a>
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

.small-heading {
	@apply text-2xl md:text-3xl font-bold bg-gradient-to-br from-white via-primary to-white bg-clip-text text-transparent;
}

.section-paragraph {
	@apply text-gray-200 text-lg;
}

.section-paragraph > a {
	@apply text-primary hover:underline;
}
</style>