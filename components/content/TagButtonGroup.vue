<template>
	<div class="space-x-2.5 flex flex-row">
		<ContentSlot :use="$slots.default" unwrap="p" />
	</div>
</template>