<script>
	import Project from "$lib/Project.svelte";
</script>

<Project
	projectTitle="Freddy Bot"
	imageAlt="Image of Freddy's discord profile."
	image="/projects/freddy.png"
	logos={[
		{ text: "Java", logoColor: "white", logo: "openjdk", color: "orange" },
		{ text: "Discord_API", logoColor: "", logo: "discord", color: "gray" }
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
		class="text-myblue hover:underline"
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
	imageAlt="Image of the bothell.band website at it's peak."
	image="/projects/bothellband.png"
	logos={[
		{ text: "JavaScript", logoColor: "", logo: "javascript", color: "blue" },
		{ text: "Svelte Kit", logoColor: "", logo: "svelte", color: "gray" },
		{ text: "TailwindCSS", logoColor: "", logo: "tailwindcss", color: "white" }
	]}
	externalLinks={[
		{
			text: "Source Code",
			href: "https://github.com/driedsponge/bothell.band",
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
		rel="noopener"
		class="text-myblue hover:underline">Essentially Ellington High School Jazz Band Competition</a
	>. In order to make the trip happen, we needed to raise a significant amount of funds. We hosted a
	variety of fundraisers but one issues I noticed was there was no central place to identify where
	and when everything was was happening. Sometimes people would be directed to facebook, to a QR
	code, or directly to the music booster store. My goal with this simple project was to create one
	single website where everyone could see all the events & fundraisers that were happening, without
	having to struggle with searching for this information. I have since graduated from high school,
	but I still maintain the website in hopes that it will prove useful for band families.
</Project>
