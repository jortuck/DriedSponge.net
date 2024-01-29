<script lang="ts">
	import Link from "$lib/project/ProjectLink.svelte";
</script>

<div class="space-y-3 py-3 text-center md:space-x-3 md:space-y-0 lg:text-left">
	<slot {Link} />
</div>
