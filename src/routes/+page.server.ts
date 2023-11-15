import type { Actions } from "./$types";
import { fail } from "@sveltejs/kit";
import { contactSchema } from "$lib/Validator";
import axios from "axios";
import { TURNSTILE_SECRET_KEY, MAILGUN_KEY, MAILGUN_DOMAIN, EMAIL } from "$env/static/private";
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
		const body = new URLSearchParams();
		body.append("to", EMAIL);
		body.append("from", `${name} <${email}>`);
		body.append("subject", "Contact From - " + subject);
		body.append("html", `test`);
		const res = await fetch(`https://api.mailgun.net/v3/${MAILGUN_DOMAIN}/messages`, {
			method: "POST",
			body: body.toString(),
			headers: {
				"Content-Type": "application/x-www-form-urlencoded",
				Authorization: "Basic " + btoa(`api:${MAILGUN_KEY}`)
			}
		});
		console.log(res.status);
		return { success: true };
	}
} satisfies Actions;
