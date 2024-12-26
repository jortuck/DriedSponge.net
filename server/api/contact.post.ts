import { z } from "zod";
import {createTransport} from "nodemailer";
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
	// const transporter = createTransport({
	// 	host: useRuntimeConfig().mailHost,
	// 	port: 465,
	// 	secure: true,
	// 	auth: {
	// 		user: useRuntimeConfig().mailUser,
	// 		pass: useRuntimeConfig().mailPassword,
	// 	}
	// })
	// const info = await transporter.sendMail({
	// 	from: '"Contact Form" <noreply@jortuck.com>', // sender address
	// 	replyTo:`"${result.data.name}" <${result.data.email}>"`, // reply ro address
	// 	to: useRuntimeConfig().mailDestination, // list of receivers
	// 	subject: result.data.subject, // Subject line
	// 	text: result.data.message, // plain text body
	// });
	return {success:true,message:"Your message has been sent!"}
});
