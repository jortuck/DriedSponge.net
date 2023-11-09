<script>
	import Project from "$lib/Project.svelte";
</script>

<Project
	projectTitle="Freddy Bot"
	imageAlt="Image of Freddy's discord profile."
	image="/projects/freddy.png"
	logos={[
		{ text: "Java", logoColor: "white", logo: "openjdk", color: "orange" },
		{ text: "Discord_API", logoColor: "", logo: "discord", color: "gray" },
		{ text: "Docker", logoColor: "white", logo: "docker", color: "blue" }
	]}
	externalLinks={[
		{
			text: "Source Code",
			href: "https://github.com/driedsponge/freddy",
			faIcon: "fa-brands fa-github"
		},
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
	image="/projects/bothellband.png"
	logos={[
		{ text: "TypeScript", logoColor: "", logo: "typescript", color: "black" },
		{ text: "Svelte Kit", logoColor: "", logo: "svelte", color: "gray" },
		{ text: "TailwindCSS", logoColor: "", logo: "tailwindcss", color: "white" },
		{ text: "Cloudflare", logoColor: "white", logo: "cloudflare", color: "orange" }
	]}
	externalLinks={[
		{
			text: "Source Code",
			href: "https://github.com/driedsponge/chica",
			faIcon: "fa-brands fa-github"
		},
		{
			text: "Live Site!",
			href: "https://bothell.band",
			faIcon: "fa-solid fa-globe"
		}
	]}
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
	projectTitle="Chica Bot"
	imageAlt="A gif animation showing Chicas ability to add captions to images."
	image="/projects/chicabot.gif"
	logos={[
		{ text: "TypeScript", logoColor: "", logo: "typescript", color: "black" },
		{ text: "Disocrd_API", logoColor: "", logo: "discord", color: "gray" },
		{ text: "Docker", logoColor: "white", logo: "docker", color: "blue" }
	]}
	externalLinks={[
		{
			text: "Source Code",
			href: "https://github.com/driedsponge/chica",
			faIcon: "fa-brands fa-github"
		},
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

<style lang="postcss">
	a {
		@apply text-myblue hover:underline;
	}
</style>
