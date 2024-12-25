import { z } from "zod";
const schema = z.object({
	name: z.string().nonempty(),
	email: z.string().email().nonempty(),
	subject: z.string().nonempty(),
	message: z.string().nonempty(),
	cftoken: z.string().nonempty(),
})
export default defineEventHandler(async (event) => {

	let result = await readValidatedBody(event,body=>schema.safeParse(body));
	if(!result.success){
		console.log(result.error.issues);
		setResponseStatus(event, 400);
		return result.error.issues
	}

	return {success:true,message:"Your message has been sent!"}
});
