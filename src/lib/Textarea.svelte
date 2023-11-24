<script lang="ts">
	import { createEventDispatcher } from "svelte";
	import { number } from "yup";

	export let label: string = "Form Field";
	export let name: string = "form-field";
	export let required: boolean = false;
	export let placeHolder: string = "Please type here.";
	export let error: string = "";
	export let value: string = "";
	export let rows: number = "6";
	export let maxLength: number | null = null;
	const dispatch = createEventDispatcher();
</script>

<label
	>{label}
	{#if required}<sup>*</sup>{/if}
	<textarea
		on:focusout={(event) => {
			dispatch("validate", event.target.value);
		}}
		maxlength={maxLength}
		{rows}
		{name}
		class:error
		placeholder={placeHolder}>{value ?? ""}</textarea
	>
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
	textarea {
		@apply my-1 block w-full rounded-md border-2 border-transparent p-2  text-black shadow-xl  transition-colors duration-200 ease-in-out focus:border-myblue focus:outline-none;
	}
	textarea.error {
		@apply border-2 border-red-400;
	}
	textarea.error + span {
		@apply visible text-red-400;
	}
</style>
