import { z } from "zod";

import { schema} from "#shared/ContactFormScheme";

export default defineEventHandler(async (event) => {

	let result = await readValidatedBody(event,body=>schema.safeParse(body));
	if(!result.success){
		console.log(result.error.issues);
		setResponseStatus(event, 400);
		return result.error.issues
	}

	return {success:true,message:"Your message has been sent!"}
});
