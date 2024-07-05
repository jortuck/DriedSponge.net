<script setup lang="ts">
	useSeoMeta({
		title:"Jordan Tucker | Home",
		ogTitle: "Jordan Tucker | Home",
		description:"Hello, my name is Jordan. I'm a student studying at the University of Washington. I enjoy creating websites, Discord bots, & more!",
		ogDescription:"Hello , my name is Jordan. I'm a student studying at the University of Washington. I enjoy creating websites, Discord bots, & more!",
		ogUrl:"https://jortuck.com"
	})
</script>
<template>
	<section
		class="fadeIn mt-20 flex flex-col items-center justify-between space-y-10 align-middle md:mt-28 lg:mt-40 lg:flex-row lg:space-y-0"
	>
		<section class="w-full text-center md:space-y-6 lg:text-left">
			<div class="h-full space-y-4 tracking-tighter lg:pr-10">
				<h1 class="h-28 text-5xl font-extrabold text-white sm:h-auto xl:text-6xl">
					{welcomeTextFinal}
				</h1>
				<h2 class="spacing text-3xl leading-10 text-gray-100 xl:text-4xl">
					My name is <span class="text-primary">Jordan</span>.
				</h2>
				<h2 class="spacing xl:text-4xls text-3xl leading-10 text-gray-100">
					I'm a student studying at the
					<a
						target="_blank"
						class="font-bold hover:no-underline text-primary"
						href="https://washington.edu">University of Washington</a
					>.
				</h2>
				<div class="space-x-3 text-center lg:text-left">

				</div>
			</div>
		</section>
	</section>

</template>