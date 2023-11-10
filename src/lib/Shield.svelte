<script lang="ts">
	export let logo: string;
	export let color: string = "gray";
	export let logoColor: string = "";
	export let text: string = "Shield;";
</script>

<img
	alt="Static Badge saying {text}"
	class="my-1 rounded-md"
	src="https://shields.driedsponge.net/badge/{text}-{color}?logo={logo}&logoColor={logoColor}&style=for-the-badge"
/>
