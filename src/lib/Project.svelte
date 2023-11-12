<script lang="ts">
	import Shield from "$lib/Shield.svelte";
	type logoShield = {
		color: string;
		logo: string;
		logoColor: string;
		text: string;
	};
	type externalLink = {
		text: string;
		faIcon: string;
		href: string;
	};
	export let logos: logoShield[];
	export let image: any;
	export let imageAlt: string;
	export let projectTitle: string;
	export let externalLinks: externalLink[] = [];
	export let repository: string;

	externalLinks.unshift({
		href: `https://github.com/driedsponge/${repository}`,
		faIcon: "fa-brands fa-github",
		text: "Source Code"
	});
</script>

<div class="my-8 rounded-lg bg-bgsecondary px-4 py-8 lg:bg-transparent">
	<div class="flex flex-col content-center items-center space-y-10 lg:flex-row lg:space-y-0">
		<div class="space-y-3 lg:w-1/2">
			<div class="space-y-3">
				<h1 class="text-center text-3xl font-extrabold text-white lg:text-left lg:text-4xl">
					{projectTitle}
				</h1>
				<div class="flex w-full flex-row flex-wrap justify-center space-x-3 lg:justify-normal">
					<img
						class="my-1 rounded-md"
						alt="GitHub commit activity for {repository}"
						src="https://shields.driedsponge.net/github/commit-activity/t/driedsponge/{repository}?style=for-the-badge&logo=github"
					/>
					{#each logos as logo}
						<Shield
							logoColor={logo.logoColor}
							text={logo.text}
							color={logo.color}
							logo={logo.logo}
						></Shield>
					{/each}
				</div>
			</div>
			<p class="text-md text-center text-white md:text-lg lg:text-left">
				<slot />
			</p>
			<div class="space-y-3 py-3 text-center md:space-x-3 md:space-y-0 lg:text-left">
				{#each externalLinks as link}
					<a
						class="block rounded-lg bg-bgborder p-3 text-center text-white transition-all duration-200 ease-in-out hover:bg-myblue hover:shadow-2xl md:inline"
						rel="noopener"
						target="_blank"
						href={link.href}><i class={link.faIcon}></i> {link.text}</a
					>
				{/each}
			</div>
		</div>
		<div class="lg:w-1/2">
			<enhanced:img
				src={image}
				class="float-right w-full rounded-2xl shadow-2xl lg:w-auto lg:max-w-md xl:max-w-xl"
				alt={imageAlt}
			/>
		</div>
	</div>
</div>
