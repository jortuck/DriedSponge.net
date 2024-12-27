<script setup lang="ts">
import Shield from "~/components/Shield.vue";
import { ZodError, type ZodErrorMap, type ZodIssue, ZodSchema } from "zod";
import { schema } from "~/shared/ContactFormScheme";
import { $fetch, FetchError } from "ofetch";
const config = useRuntimeConfig();
useSeoMeta({
	title: "Home | Jordan Tucker",
	ogTitle: "Home | Jordan Tucker",
	description: "Hello, my name is Jordan. I'm a student studying Informatics at the University of Washington. I enjoy creating websites, Discord bots, & more!",
	ogDescription: "Hello , my name is Jordan. I'm a student studying Informatics at the University of Washington. I enjoy creating websites, Discord bots, & more!",
	ogUrl: "https://jortuck.com"
});


let contactForm = ref({
	name:"",
	email:"",
	subject:"",
	message:"",
	cftoken:"",
})
type Errors = {
	name: string;
	email: string;
	subject: string;
	message: string;
	cftoken: string;
}
let errors = ref<Errors>({
	name:"",
	email:"",
	subject:"",
	message:"",
	cftoken:"",
})
let turnstileId = ref("");
let formError = ref("");
let formSuccess = ref(false);
onMounted(()=>{
	//@ts-ignore
	window.turnstile.ready(function () {
		// @ts-ignore
		turnstileId = window.turnstile.render(".cf-turnstile", {
			sitekey: config.public.turnstileKey,
			callback: function (token: string) {
				console.log(`Challenge Success ${token}`);
				 contactForm.value.cftoken = token;
				},
			"error-callback": function () {
					errors.value.cftoken = "Unfortunately, it looks like you have been detected as a bot. Please refresh the page.";
				}
		});
	});
})
function validate(schema:ZodSchema, data:object, field: keyof Errors) {
	let result = schema.safeParse(data);
	if(!result.success){
		errors.value[field] = result.error.issues[0].message;
		console.log(result.error.issues[0]);

	}else{
		errors.value[field] = ""
	}
}
const isErrors = computed(()=>{
	let result : boolean = false;
	Object.keys(errors.value).forEach((key:string) => {
		if(errors.value[key as keyof Errors]  != ""){
			result = true;
		}
	})
	return result;
})
async function handleSubmit(){
	let response = await $fetch("/api/contact",{method:"POST", body:contactForm.value,
	}).catch((error: FetchError)=>{
			console.log(error.status);
			if(error.status == 400){
				console.log(error.data)
				error.data.forEach((element: ZodIssue)=>{
					errors.value[element.path[0] as keyof Errors] = element.message;
				})
			}else if(error.status == 403){
				errors.value["cftoken" as keyof Errors] = error.data.message;
			}else{
				formError.value = "An internal error occured on my end. Please reach out using LinkedIn or try again later."
				// @ts-ignore
				window.turnstile.reset(turnstileId)
			}
	})
	if(response){
		if(response.success){
			formSuccess.value = true;
			formError.value = ""
			// @ts-ignore
			window.turnstile.reset(turnstileId)
		}
	}
}
</script>
<template>
	<div class="space-y-32">
		<section
			class="mt-20 md:mt-28 lg:mt-40"
		>
			<section class="w-full text-center md:space-y-6 lg:text-left">
				<div
					class="h-full space-y-9 lg:space-y-6 tracking-tighter lg:pr-10 bg-gradient-to-br from-white via-primary to-white to-70%  bg-clip-text text-transparent">
					<h1 class="text-5xl lg:text-7xl font-semibold xl:text-8xl tracking-tighter select-none cooltext">
						Hi, I'm Jordan.
					</h1>
					<h2 class="text-4xl font-semibold sm:h-auto xl:text-6xl tracking-tighter select-none cooltext">I'm an
						Informatics student
						at the University of Washington.</h2>
					<div class="text-5xl space-x-6">
						<a
							target="_blank"
							class="social-link cooltext"
							href="https://github.com/jortuck"
							title="Github"
						>
							<i class="fa-brands fa-github"></i>
						</a>
						<a
							target="_blank"
							class="social-link cooltext"
							href="https://linkedin.com/in/jortuck"
							title="Linked In"
						>
							<i class="fa-brands fa-linkedin"></i>
						</a>
					</div>
				</div>
			</section>
		</section>
		<section class="mb-96 space-y-10">
			<div class="space-y-8">
				<ProseH2>
					About Me
				</ProseH2>
				<ProseP>
					Hi my name is Jordan, I'm a student studying
					<NuxtLink class="text-primary hover:underline" external target="_blank"
										to="https://ischool.uw.edu/programs/informatics">Informatics
					</NuxtLink>
					at the
					<NuxtLink to="https://washington.edu" external target="_blank">University of
						Washington
					</NuxtLink>
					. I have been teaching myself
					to program since 2019, and have focused my efforts in web development, server-side applications, and data
					science applications. My most recent project involved working at the University of Washington's
					<NuxtLink class="text-primary hover:underline" to="https://ocean.washington.edu" external target="_blank">
						School
						of Oceanography
					</NuxtLink>
					as a research assistant, building an interactive web application for the visualization
					of paleocliamte data reconstructions. You can check it out at
					<NuxtLink class="text-primary hover:underline" to="https://pv.jortuck.com" external target="_blank">https://pv.jortuck.com</NuxtLink>.
				</ProseP>
			</div>
			<div>
				<ProseH2>
					Featured Projects
				</ProseH2>
			</div>
			<div class="space-y-4">
				<ProseH2 id="contact">
					Contact {{contactForm.cftoken}}
				</ProseH2>
				<ProseP>
					Fill out this form to send a message directly to my inbox! No matter what you have to say, I would love to
					hear from you! Feedback on this website is also much appreciated. You can also reach me on LinkedIn if that's
					your preferred method of communication, my username is <ProseA href="https://linkedin.com/in/jortuck" target="_blank">jortuck</ProseA>.
				</ProseP>
				<ProseP v-if="formError">
					<span class="text-red-400 font-bold">{{formError}}</span>
				</ProseP>
				<div class="flex flex-row items-center justify-center w-full">
					<form @submit.prevent="handleSubmit" class="relative my-6 rounded-md flex flex-col space-y-5 w-full">
						<Transition>
						<div v-if="formSuccess" class="absolute font-bold h-full w-full bg-base-100 border-2 border-base-300 bg-opacity-75 backdrop-blur-2xl rounded-md flex flex-col space-y-10 items-center justify-center">
							<h1 class="text-green-500 text-center text-5xl">Success!</h1>
							<ProseP>Your message was successfully sent. I will do my best to get back to you within 24 hours.</ProseP>
							<button
								@click="()=>{
									formSuccess = false
									contactForm = {name: '', email: '', subject: '', message: '', cftoken: contactForm.cftoken}
								}"
								type="reset"
								class="text-white hover:bg-base-300 bg-base-200 rounded-md p-3 transition-colors duration-200">Submit Another Response</button>
						</div>
						</Transition>
						<div class="flex md:flex-row flex-col w-full md:space-x-4 space-y-5 md:space-y-0">
							<label
							>Name*
								<input v-model="contactForm.name" name="name" type="text" placeholder="Chris P. Bacon" :class='{error:errors["name"]}'
											 maxlength="50"
											 @focusout="(()=>{validate(schema.pick({name:true}),{name:contactForm.name},'name')})" />
								<span class="error">{{errors["name"]}}</span>
							</label>
							<label
							>Email*
								<input v-model="contactForm.email" name="email" type="email" placeholder="email@example.com" :class='{error:errors["email"]}'
											 maxlength="50"
											 @focusout="(()=>{validate(schema.pick({email:true}),{email:contactForm.email},'email')})"/>
								<span class="error">{{errors["email"]}}</span>
							</label>
						</div>
						<div class="space-y-5">
							<label
							>Subject (required)
								<input v-model="contactForm.subject" placeholder="A nice message." name="subject" type="text" :class='{error:errors["subject"]}'
											 maxlength="50"
											 @focusout="(()=>{validate(schema.pick({subject:true}),{subject:contactForm.subject},'subject')})"/>
							<span class="error">{{errors["subject"]}}</span>
							</label>
							<label
							>Message*
								<textarea v-model="contactForm.message" name="message"
													rows="4"
													maxlength="1000"
													@focusout="(()=>{validate(schema.pick({message:true}),{message:contactForm.message},'message')})" :class='{error:errors["message"]}'
													placeholder="Had a slight weapons malfunction but, uh everything’s perfectly all right now. We’re fine. We’re all fine here now. Thank you. How are you?"></textarea>
								<span class="error">{{errors["message"]}}</span>
							</label>
						</div>
						<div
							class="flex flex-col content-center items-center space-y-3 md:flex-row md:space-x-3 md:space-y-0"
						>
							<div class="cf-turnstile"></div>
							<span class="error font-bold">{{errors["cftoken"]}}</span>
						</div>
						<button :disabled="isErrors" type="submit" class="submit-btn">
							<i class="fa-solid fa-paper-plane"></i> Send
						</button>
					</form>
				</div>
			</div>
		</section>
	</div>
</template>
<style scoped lang="postcss">
.v-enter-active,
.v-leave-active {
	transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
	opacity: 0;
}
.social-link {
	@apply transition-colors duration-200 ease-in-out hover:text-white;
}

input {
	@apply bg-base-200  active:bg-base-300 focus:bg-base-300 text-white focus:border-primary;
	@apply block w-full mt-1 rounded-md border-2 border-transparent p-2 transition-colors duration-200 ease-in-out focus:outline-none font-normal;
}

label {
	@apply block w-full text-white font-bold;
}

input.error, textarea.error {
	@apply border-2 border-red-400;
}
label > span.error{
	@apply font-normal text-sm;
}
span.error{
	@apply text-red-400;
}
.submit-btn{
	@apply text-white hover:bg-primary disabled:hover:bg-base-200;
	@apply block bg-base-200 rounded-md p-3 transition-colors duration-200 ease-in-out disabled:hover:cursor-not-allowed;
}
textarea {
	@apply bg-base-200 active:bg-base-300 focus:bg-base-300 text-white focus:border-primary;
	@apply block w-full rounded-md border-2 border-transparent p-2 mt-1 transition-colors duration-200 ease-in-out focus:outline-none font-normal;
}

.small-heading {
	@apply text-2xl md:text-3xl font-bold bg-gradient-to-br from-white via-primary to-white bg-clip-text text-transparent;
}

.section-paragraph {
	@apply text-gray-200 text-lg;
}

.section-paragraph > a {
	@apply text-primary hover:underline;
}
</style>