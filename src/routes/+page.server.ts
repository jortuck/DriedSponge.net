import type { Actions, PageServerLoad } from "./$types";
import { fail } from "@sveltejs/kit";
import { contactSchema } from "$lib/Validator";
import { TURNSTILE_SECRET_KEY, MAILGUN_KEY, MAILGUN_DOMAIN, EMAIL } from "$env/static/private";
import { API_KEY } from "$env/static/private";
import { PUBLIC_API_HOST } from "$env/static/public";

export const load: PageServerLoad = async ({ params }) => {
	let data = await fetch(`${PUBLIC_API_HOST}/api/projects?populate=*&sort=createdAt:asc`, {
		headers: {
			Authorization: `Bearer ${API_KEY}`
		}
	});
	let projects = await data.json();

	return {
		projects: projects.data
	};
};

export const actions = {
	default: async ({ request }) => {
		const data = await request.formData();
		const name = data.get("name");
		const email = data.get("email");
		const subject = data.get("subject");
		const message = data.get("message");
		const response = data.get("cf-turnstile-response");
		const captcha = await fetch("https://challenges.cloudflare.com/turnstile/v0/siteverify", {
			method: "POST",
			headers: {
				"Content-Type": "application/json"
			},
			body: JSON.stringify({
				secret: TURNSTILE_SECRET_KEY,
				response: response
			})
		}).then((response) => response.json());
		console.log(captcha);
		if (!captcha.success) {
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
		body.append("from", `${name} <noreply@driedsponge.net>`);
		body.append("h:Reply-To", `${name} <${email!.toString()}>`);
		body.append("subject", "Portfolio Contact From Response - " + subject);
		body.append("text", message!.toString());
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
