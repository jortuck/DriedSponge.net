<script lang="ts">
	export let logo: string;
	export let color: string = "gray";
	export let logoColor: string = "";
	export let text: string = "Shield;";
</script>

<img
	alt="Static Badge saying {text}"
	src="https://img.shields.io/badge/{text}-{color}?logo={logo}&logoColor={logoColor}"
/>
