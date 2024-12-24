<template>
	<div class="md:space-x-2.5 md:flex-row space-y-3 md:space-y-0 flex flex-col">
		<ContentSlot :use="$slots.default" unwrap="p" />
	</div>
</template>