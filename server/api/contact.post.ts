import { z } from "zod";
const schema = z.object({
	name: z.string(),
	email: z.string().email(),
	subject: z.string(),
	message: z.string().nonempty(),
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
