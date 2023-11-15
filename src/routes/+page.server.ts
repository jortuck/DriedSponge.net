import type { Actions } from "./$types";
import { fail } from "@sveltejs/kit";
import { contactSchema } from "$lib/Validator";
import type { ValidationError } from "yup";
import axios from "axios";
import { TURNSTILE_SECRET_KEY, MAILGUN_KEY, MAILGUN_DOMAIN, EMAIL } from "$env/static/private";
import formData from "form-data";
import Mailgun from "mailgun.js";
export const actions = {
	default: async ({ request }) => {
		const data = await request.formData();
		const name = data.get("name");
		const email = data.get("email");
		const subject = data.get("subject");
		const message = data.get("message");
		const response = data.get("cf-turnstile-response");
		const captcha = await axios.post("https://challenges.cloudflare.com/turnstile/v0/siteverify", {
			secret: TURNSTILE_SECRET_KEY,
			response: response
		});
		if (!captcha.data.success) {
			return fail(400, {
				success: false,
				msg: "You failed our CAPTCHA. Please try submitting again."
			});
		}
		try {
			await contactSchema.validate({ name, email, subject, message }, { abortEarly: false });
		} catch (err: any) {
			let errors: any = {};
			for (let inner of err.inner) {
				errors[inner.path] = inner.errors[0];
			}
			return fail(400, {
				success: false,
				error: errors
			});
		}
		const mailgun = new Mailgun(formData);
		const client = mailgun.client({ username: "api", key: MAILGUN_KEY });
		const messageData = {
			from: `${name} <${email}>`,
			to: EMAIL,
			subject: "Contact From - " + subject,
			text: message
		};

		client.messages
			// @ts-ignore
			.create(MAILGUN_DOMAIN, messageData)
			.then((res) => {
				console.log(res);
			})
			.catch((err) => {
				console.error(err);
			});
		return { success: true };
	}
} satisfies Actions;
