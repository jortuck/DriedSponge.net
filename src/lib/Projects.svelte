<script>
	import Project from "$lib/Project.svelte";
	import chicabot from "$lib/assets/projects/chicabot.webp";
	import bothellband from "$lib/assets/projects/bothellband.png?enhanced";
	import freddy from "$lib/assets/projects/freddy.png?enhanced";
	import driedspongenet from "$lib/assets/projects/driedspongenet.png?enhanced";
	import server from "$lib/assets/projects/server.jpg?enhanced";
</script>

<Project
	projectTitle="Freddy Bot"
	imageAlt="Image of Freddy's discord profile."
	image={freddy}
	logos={[
		{ text: "Discord_API", logoColor: "white", logo: "discord", color: "gray" },
		{ text: "Docker", logoColor: "white", logo: "docker", color: "blue" },
		{ text: "Java", logoColor: "white", logo: "openjdk", color: "orange" }
	]}
	repository="freddy"
	externalLinks={[
		{
			text: "Test it out!",
			href: "https://discord.com/api/oauth2/authorize?client_id=914454054808211476&permissions=3230720&scope=bot",
			faIcon: "fa-brands fa-discord"
		}
	]}
>
	This bot was created using <a
		target="_blank"
		rel="noopener"
		href="https://github.com/discord-jda/JDA">Discord JDA</a
	> (Java Discord API). I was inspired to make it after Google started cracking down on music bots that
	were using YouTube as an audio source. Because of this, my friends and I could no longer listen to
	music together in a discord call. While this bot I created still uses YouTube as an audio source, I
	doubt Google will send me a cease and desists letter because it's used personally, not commercially.
	If I do end up getting a letter from Google though, I would be proud of myself for managing to get
	their attention. My goal is to make it easy to self host, so people who need music in their Discord
	servers can have easy access to it.
</Project>
<Project
	projectTitle="bothell.band"
	imageAlt="Image of the bothell.band website."
	image={bothellband}
	logos={[
		{ text: "Cloudflare", logoColor: "white", logo: "cloudflare", color: "orange" },
		{ text: "Svelte Kit", logoColor: "", logo: "svelte", color: "gray" },
		{ text: "TailwindCSS", logoColor: "", logo: "tailwindcss", color: "white" },
		{ text: "TypeScript", logoColor: "", logo: "typescript", color: "black" }
	]}
	externalLinks={[
		{
			text: "Live Site!",
			href: "https://bothell.band",
			faIcon: "fa-solid fa-globe"
		}
	]}
	repository="bothell.band"
>
	This website was created as a small side project to help assist the fundraising efforts for my
	high school jazz band at the time. During my senior year of high school, our jazz band was
	selected as a finalist for the <a
		href="https://jazz.org/education/school-programs/essentially-ellington/"
		target="_blank"
		rel="noopener">Essentially Ellington High School Jazz Band Competition</a
	>. In order to make the trip happen, we needed to raise a significant amount of funds. We hosted a
	variety of fundraisers but one issues I noticed was there was no central place to identify where
	and when everything was was happening. Sometimes people would be directed to facebook, to a QR
	code, or directly to the music booster store. My goal with this simple project was to create one
	single website where everyone could see all the events & fundraisers that were happening, without
	having to struggle with searching for this information. I have since graduated from high school,
	but I still maintain the website in hopes that it will prove useful for band families.
</Project>
<Project
	enhance={false}
	projectTitle="Chica Bot"
	imageAlt="A gif animation showing Chicas ability to add captions to images."
	image={chicabot}
	logos={[
		{ text: "Disocrd_API", logoColor: "white", logo: "discord", color: "gray" },
		{ text: "Docker", logoColor: "white", logo: "docker", color: "blue" },
		{ text: "TypeScript", logoColor: "", logo: "typescript", color: "black" }
	]}
	repository="chica"
	externalLinks={[
		{
			text: "Test it out!",
			href: "https://discord.com/api/oauth2/authorize?client_id=813807335502905344&permissions=117760&scope=bot",
			faIcon: "fa-brands fa-discord"
		}
	]}
>
	I created this bot using <a
		target="_blank"
		rel="noopener"
		href="https://discord.js.org/">Discord JS</a
	>. My goal was to establish a way for my friends to easily create memes on the fly in a Discord
	channel without having to go online to manually make them. I decided to use a combination of
	<a
		href="https://github.com/lovell/sharp"
		rel="noopener"
		target="_blank">sharp</a
	>
	and
	<a
		href="https://github.com/Automattic/node-canvas"
		target="_blank"
		rel="noopener">node-canvas</a
	> to achieve the ability to edit images. The bot supports JPEGs, PNGs, GIFs, and it even has the ability
	to pull images directly from file URLs or Tenor!
</Project>
<Project
	projectTitle="This Website"
	imageAlt="A picture of the driedsponge.net website from July 20th, 2020."
	image={driedspongenet}
	logos={[
		{ text: "Cloudflare", logoColor: "white", logo: "cloudflare", color: "orange" },
		{ text: "Svelte Kit", logoColor: "", logo: "svelte", color: "gray" },
		{ text: "TailwindCSS", logoColor: "", logo: "tailwindcss", color: "white" },
		{ text: "TypeScript", logoColor: "", logo: "typescript", color: "black" }
	]}
	repository="driedsponge.net"
>
	I know it's unconventional to put a portfolio on a portfolio, but I thought I would add it here
	because this website has a lengthy history (as you can tell by the 1k+ commits). It was the first
	website I ever created on my own, and as I kept learning I kept changing it. Whenever I discovered
	a new stack or technology, I would use this website as a sandbox for testing it. If you take the
	time to view the commit history, you'll be able to see this website evolve from plain HTML & CSS,
	to PHP, to Laravel & Vue, and now to Svelte Kit. I don't plan on redoing this website after Svelte
	Kit, instead I hope to spend more time on other projects.
</Project>
<Project
	projectTitle="My Home Server"
	imageAlt="A picture of my home server."
	image={server}
	logos={[
		{ text: "Ubuntu Server", logoColor: "white", logo: "ubuntu", color: "orange" },
		{ text: "AMD Ryzen 7 3800X", logoColor: "white", logo: "amd", color: "red" },
		{ text: "ASRock Rack X570D4U", logoColor: "white", logo: "", color: "gray" },
		{ text: "64GB DDR4 3200MHZ", logoColor: "white", logo: "", color: "gray" },
		{ text: "Samsung 980 PRO 1TB NVME SSD", logoColor: "white", logo: "", color: "gray" }
	]}
>
	This is the server I use to host most of my personal projects. I originally started experimenting
	with self hosting a few years ago as an effort to save money, and it just became a hobby of mine.
	My server was originally an old Windows 7 laptop which I installed Linux on because my parents no
	longer needed it, and it has since become it's own dedicated machine running on old computer parts
	from my PC or hardware specifically purchased for it. Today I use it to host a variety of services
	such as Minecraft servers, <a
		href="https://www.jetbrains.com/teamcity/"
		target="_blank"
		rel="noopener">Teamcity</a
	>,
	<a
		href="https://appwrite.io"
		target="_blank"
		rel="noopener">Appwrite</a
	>,
	<a
		href="https://shields.io"
		target="_blank"
		rel="noopener">Shields</a
	>, and many of my personal projects that require more computing resources to run.
</Project>

<style lang="postcss">
	a {
		@apply text-myblue hover:underline;
	}
</style>
