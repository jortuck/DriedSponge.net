<script lang="ts">
	import { createEventDispatcher } from "svelte";

	export let label: string = "Form Field";
	export let name: string = "form-field";
	export let required: boolean = false;
	export let placeHolder: string = "Please type here.";
	export let error: string = "";
	export let value: string = "";
	export let maxLength: string = "";
	const dispatch = createEventDispatcher();
</script>

<label
	>{label}
	{#if required}
		<sup>*</sup>
	{/if}
	<input
		on:focusout={(event) => {
			dispatch("validate", event.target.value);
		}}
		maxlength={maxLength}
		{name}
		value={value ?? ""}
		placeholder={placeHolder}
		class:error
	/>
	<span>
		<i class="fa-solid fa-triangle-exclamation"></i>
		{#if error}
			{error}
		{/if}
	</span>
</label>

<style lang="postcss">
	label {
		@apply my-2 block w-full text-white;
	}
	label > span {
		@apply invisible mt-1 block text-sm italic;
	}
	input {
		@apply my-1 block w-full rounded-md border-2 border-transparent p-2  text-black shadow-xl  transition-colors duration-200 ease-in-out focus:border-myblue focus:outline-none;
	}
	input.error {
		@apply border-2 border-red-400;
	}
	input.error + span {
		@apply visible text-red-400;
	}
</style>
