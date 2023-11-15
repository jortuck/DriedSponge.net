<script>
	import { onMount } from "svelte";
	let scrolled = false;
	let expanded = false;
	let home = true;
	let active = "home";
	function evaluateScroll() {
		scrolled = window.scrollY > 0;
		if (
			window.scrollY >=
				document.getElementById("projects").getBoundingClientRect().top +
					window.pageYOffset -
					120 &&
			window.scrollY <
				document.getElementById("contact").getBoundingClientRect().top + window.pageYOffset - 120
		) {
			active = "projects";
		} else if (
			window.scrollY >=
			document.getElementById("contact").getBoundingClientRect().top + window.pageYOffset - 120
		) {
			active = "contact";
		} else {
			active = "home";
		}
	}
	function scrollTo(yPos) {
		window.scrollTo({ top: yPos, behavior: "smooth" });
	}
	onMount(() => {
		evaluateScroll();
	});
</script>

<svelte:window on:scroll={evaluateScroll} />
<div class="sticky top-0 z-50 will-change-transform">
	<nav
		class="flex border-b-2 border-b-bgborder bg-bgsecondary py-4 transition-colors duration-200 ease-in-out lg:border-0 lg:bg-transparent"
		class:scrolled
	>
		<div
			class="max-w-8xl container mx-auto flex hidden items-center justify-between px-2 lg:flex xl:px-0"
		>
			<div>
				<a
					class="text-3xl font-extrabold text-white"
					href="/"><span class="text-myblue">Jordan</span> Tucker</a
				>
			</div>
			<div class="space-x-10">
				<a
					class="text-xl text-gray-400 transition-colors duration-200 ease-in-out hover:text-white"
					class:text-gray-400={active !== "home"}
					class:text-white={active === "home"}
					on:click|preventDefault={() => {
						scrollTo(0);
					}}
					href="/"
				>
					Home
				</a>
				<a
					class="text-xl text-gray-400 transition-colors duration-200 ease-in-out hover:text-white"
					href="#projects"
					class:text-gray-400={active !== "projects"}
					class:text-white={active === "projects"}
				>
					Projects
				</a>
				<a
					class="text-xl text-gray-400 transition-colors duration-200 ease-in-out hover:text-white"
					href="#contact"
					class:text-gray-400={active !== "contact"}
					class:text-white={active === "contact"}
				>
					Contact
				</a>
				<a
					class="text-xl text-gray-400 transition-colors duration-200 ease-in-out hover:text-white"
					href="https://github.com/driedsponge"
					rel="noopener"
					target="_blank"
				>
					Github
				</a>
			</div>
		</div>
		<div class="container mx-3 max-w-full transition-all duration-200 ease-in-out lg:hidden">
			<div class="flex items-center justify-between">
				<div>
					<a
						class="text-3xl font-extrabold text-white"
						href="/"><span class="text-myblue">J</span>T</a
					>
				</div>

				<div>
					<button
						on:click={(event) => {
							expanded = !expanded;
						}}
						class="text-white"
					>
						<img
							class="w-6"
							class:hidden={!expanded}
							src="/icons/cross.svg"
							alt="Menu Button"
						/>
						<img
							class:hidden={expanded}
							class="w-6"
							src="/icons/menu-burger.svg"
							alt="Menu Button"
						/>
					</button>
				</div>
			</div>
			<div />
		</div>
	</nav>
	<div
		class:scale-y-0={!expanded}
		class="absolute z-10 w-full origin-top bg-bgsecondary transition-all duration-200 ease-in-out lg:hidden"
	>
		<ul class="space-y-4 py-4 text-center">
			<li>
				<a
					class="text-xl transition-colors duration-200 ease-in-out hover:text-white"
					class:text-gray-400={active !== "home"}
					class:text-white={active === "home"}
					on:click|preventDefault={() => {
						expanded = false;
						scrollTo(0);
					}}
					href="/"
				>
					Home
				</a>
			</li>
			<li>
				<a
					class="text-xl transition-colors duration-200 ease-in-out hover:text-white"
					href="#projects"
					class:text-gray-400={active !== "projects"}
					class:text-white={active === "projects"}
					on:click|preventDefault={() => {
						expanded = false;
						scrollTo(
							document.getElementById("projects").getBoundingClientRect().top + window.pageYOffset
						);
					}}
				>
					Projects
				</a>
			</li>
			<li>
				<a
					class="text-xl transition-colors duration-200 ease-in-out hover:text-white"
					href="#contact"
					class:text-gray-400={active !== "contact"}
					class:text-white={active === "contact"}
					on:click|preventDefault={() => {
						expanded = false;
						scrollTo(
							document.getElementById("contact").getBoundingClientRect().top + window.pageYOffset
						);
					}}
				>
					Contact
				</a>
			</li>
			<li>
				<a
					class="text-xl text-gray-400 transition-colors duration-200 ease-in-out hover:text-white"
					on:click={() => {
						expanded = false;
					}}
					href="https://github.com/driedsponge"
					rel="noopener"
					target="_blank"
				>
					Github
				</a>
			</li>
		</ul>
	</div>
</div>

<style lang="postcss">
	.scrolled {
		@apply border-b-2 bg-bgsecondary;
	}
</style>
