import { object, string, number, date } from "yup";
export const contactSchema = object({
	name: string().required("Please provide a name.").max(50, "The maximum length is 50 characters!"),
	email: string()
		.required("Please provide a valid email address.")
		.email("Please provide a valid email address.")
		.max(50),
	subject: string()
		.required("Please let me know what you would like to chat about.")
		.max(100, "The maximum length is 100 characters!"),
	message: string()
		.required("Please write me a message.")
		.max(500, "Your message must be less than 1000 characters.")
});
