<script lang="ts">
	import Shields from "$lib/project/ProjectShields.svelte";
	import Title from "$lib/project/ProjectTitle.svelte";
</script>

<div class="space-y-3">
	<slot
		{Shields}
		{Title}
	/>
</div>
