import { z } from "zod";

import { schema} from "#shared/ContactFormScheme";
import { $fetch } from "ofetch";

export default defineEventHandler(async (event) => {

	let result = await readValidatedBody(event,body=>schema.safeParse(body));

	if(!result.success){
		setResponseStatus(event, 400);
		return result.error.issues
	}

	let captcha = await $fetch("https://challenges.cloudflare.com/turnstile/v0/siteverify",{
		"method": "POST",
		body: {
			secret: useRuntimeConfig().turnstileSecret,
			response: result.data["cftoken"],
		},
	})
	if(!captcha.success){
		setResponseStatus(event, 403);
		return {message:"Unfortunately my system has detected you as a bot. Please refresh your page or reach out via LinkedIn."}
	}

	return {success:true,message:"Your message has been sent!"}
});
